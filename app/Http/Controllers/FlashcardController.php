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
        $flashcard = Flashcard::where('id', $request->flashcard_id)
                               ->where('user_id', Auth::id())
                               ->firstOrFail();

        $correct = $request->answer === $flashcard->answer;
        $points = $correct ? rand(50, 100) : 0;

        // Koppel de flashcard aan de user met de informatie of het correct was
        auth()->user()->flashcards()->attach($flashcard->id, ['correct' => $correct]);
        auth()->user()->increment('points', $points);

        // Controleer of alle flitskaarten zijn voltooid
        $totalFlashcards = $subject->flashcards()->where('user_id', Auth::id())->count();
        $answeredFlashcards = auth()->user()->flashcards()->where('subject_id', $subject->id)->count();
        $finished = $answeredFlashcards >= $totalFlashcards;

        return view('dashboard.flashcards.answer_result', compact('correct', 'points', 'finished', 'subject'));
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
}
