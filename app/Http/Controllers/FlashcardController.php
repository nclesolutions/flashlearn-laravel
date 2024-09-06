<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Flashcard;
use Illuminate\Support\Facades\Auth;

class FlashcardController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('dashboard.flashcards.index', compact('subjects'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('dashboard.flashcards.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'flashcards' => 'required|array',
            'flashcards.*.question' => 'required|string',
            'flashcards.*.answer' => 'required|string',
        ]);

        foreach ($validated['flashcards'] as $flashcardData) {
            Flashcard::create([
                'subject_id' => $validated['subject_id'],
                'user_id' => Auth::id(),
                'question' => $flashcardData['question'],
                'answer' => $flashcardData['answer'],
            ]);
        }

        return redirect()->route('dashboard.flashcards.index')->with('success', 'Flitskaarten toegevoegd!');
    }

    public function start(Subject $subject)
    {
        $flashcard = $subject->flashcards()
            ->where('user_id', Auth::id())
            ->whereDoesntHave('users', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->first();

        if (!$flashcard) {
            return redirect()->route('dashboard.flashcards.result', $subject->id);
        }

        return view('dashboard.flashcards.start', compact('subject', 'flashcard'));
    }

    public function answer(Request $request, Subject $subject)
    {
        // Retrieve the flashcard by ID
        $flashcard = Flashcard::where('id', $request->flashcard_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Check if the user has already answered this flashcard
        $alreadyAnswered = auth()->user()->flashcards()->where('flashcard_id', $flashcard->id)->exists();

        if ($alreadyAnswered) {
            // If already answered, retrieve the previous answer status
            $previousAnswer = auth()->user()->flashcards()->where('flashcard_id', $flashcard->id)->first();
            $correct = $previousAnswer->pivot->correct;  // Use the previous answer to determine if it was correct or not

            // Return the answer_result view without awarding points again
            $totalFlashcards = $subject->flashcards()->where('user_id', Auth::id())->count();
            $answeredFlashcards = auth()->user()->flashcards()->where('subject_id', $subject->id)->count();
            $finished = $answeredFlashcards >= $totalFlashcards;
            $progress = ($answeredFlashcards / $totalFlashcards) * 100;

            return view('dashboard.flashcards.answer_result', compact('correct', 'finished', 'progress', 'subject'));
        }

        // Otherwise, proceed with the new answer
        $correct = $request->answer === $flashcard->answer;
        $points = $correct ? rand(50, 100) : 0;

        // Attach the flashcard to the user and mark whether the answer was correct
        auth()->user()->flashcards()->attach($flashcard->id, ['correct' => $correct]);
        auth()->user()->increment('points', $points);

        // Check if all flashcards are completed
        $totalFlashcards = $subject->flashcards()->where('user_id', Auth::id())->count();
        $answeredFlashcards = auth()->user()->flashcards()->where('subject_id', $subject->id)->count();
        $finished = $answeredFlashcards >= $totalFlashcards;

        // Calculate progress
        $progress = ($answeredFlashcards / $totalFlashcards) * 100;

        return view('dashboard.flashcards.answer_result', compact('correct', 'points', 'finished', 'progress', 'subject'));
    }


    public function result(Subject $subject)
    {
        $correctAnswers = auth()->user()->flashcards()
            ->where('subject_id', $subject->id)
            ->wherePivot('correct', true)
            ->count();

        $totalFlashcards = $subject->flashcards()
            ->where('user_id', Auth::id())
            ->count();

        return view('dashboard.flashcards.result', compact('subject', 'correctAnswers', 'totalFlashcards'));
    }

    // Import method
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:json',
        ]);

        $file = $request->file('file');
        $jsonData = json_decode(file_get_contents($file->getRealPath()), true);

        foreach ($jsonData as $flashcardData) {
            Flashcard::create([
                'subject_id' => $flashcardData['subject_id'],
                'user_id' => Auth::id(),
                'question' => $flashcardData['question'],
                'answer' => $flashcardData['answer'],
            ]);
        }

        return redirect()->route('dashboard.flashcards.index')->with('success', 'Flitskaarten succesvol geïmporteerd!');
    }


    // Export method
    public function export()
    {
        $flashcards = Flashcard::where('user_id', Auth::id())->get();

        $filename = 'composer require phpoffice/phpspreadsheet
.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['subject_id', 'question', 'answer']);  // Header

        foreach ($flashcards as $flashcard) {
            fputcsv($handle, [$flashcard->subject_id, $flashcard->question, $flashcard->answer]);
        }

        fclose($handle);

        return response()->download($filename);
    }


}
