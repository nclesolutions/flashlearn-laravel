<?php
namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Student; // Vergeet niet om de Student model te importeren
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use IntlDateFormatter;
use DateTime;

class HomeworkController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Haal de user_id van de ingelogde gebruiker op
        $userId = Auth::id();

        // Haal de studentgegevens van de ingelogde gebruiker op
        $student = Student::where('user_id', $userId)->first();
        $classId = $student->class_id;

        // Haal alle study_guide_ids op die bij de klas horen
        $studyGuideIds = DB::table('study_guides')
            ->where('class_id', $classId)
            ->pluck('id');

        // Query om het huiswerk op te halen op basis van study_guide_ids
        $homework = DB::table('homework')
            ->whereIn('study_guide_id', $studyGuideIds)
            ->orderBy('return_date')
            ->get();

        // Formatter voor de datum
        $locale = 'nl_NL';
        $formatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'Europe/Amsterdam',
            null,
            'd MMMM yyyy'
        );

        // Groepeer de resultaten op inleverdatum
        $groupedResults = [];
        foreach ($homework as $row) {
            $date = new DateTime($row->return_date);
            $inleverDate = $formatter->format($date);

            // Maak de eerste letter van de maand een hoofdletter
            $inleverDateParts = explode(' ', $inleverDate);
            if (isset($inleverDateParts[1])) {
                $inleverDateParts[1] = ucfirst($inleverDateParts[1]);
            }
            $inleverDate = implode(' ', $inleverDateParts);

            $groupedResults[$inleverDate][] = $row;
        }

        return view('dashboard.homework.index', compact('groupedResults'));
    }

    public function view($id)
    {
        // Fetch homework by ID
        $homework = Homework::where('unique_id', $id)->first();
        $userId = Auth::id();
        $student = Student::where('user_id', $userId)->first();

        // Check if homework belongs to the logged-in user
        if (!DB::table('study_guides')
            ->where('id', $homework->study_guide_id)
            ->where('class_id', $student->class_id)
            ->exists()) {
            return redirect('/huiswerk');
        }

        // Formatter voor de datum in de weergave
        $locale = 'nl_NL';
        $formatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'Europe/Amsterdam',
            null,
            'd MMMM yyyy'
        );

        // Format the return_date of the specific homework
        $date = new DateTime($homework->return_date);
        $homework->formatted_date = $formatter->format($date);

        // Haal andere huiswerktaken op voor de klas van de gebruiker
        $userId = Auth::id();
        $student = Student::where('user_id', $userId)->first();
        $classId = $student->class_id;
        $studyGuideIds = DB::table('study_guides')
            ->where('class_id', $classId)
            ->pluck('id');
        $groupedResults = Homework::whereIn('study_guide_id', $studyGuideIds)
            ->orderBy('return_date')
            ->get()
            ->groupBy(function ($item) use ($formatter) {
                $date = new DateTime($item->return_date);
                $formattedDate = $formatter->format($date);

                // Zorg ervoor dat de eerste letter van de maand een hoofdletter is
                $formattedDateParts = explode(' ', $formattedDate);
                if (isset($formattedDateParts[1])) {
                    $formattedDateParts[1] = ucfirst($formattedDateParts[1]);
                }

                return implode(' ', $formattedDateParts);
            });

        return view('dashboard.homework.view', compact('homework', 'groupedResults', 'id'));
    }

    // API Endpoint: Haal al het huiswerk op voor de ingelogde gebruiker op basis van de klas
    public function APIIndex()
    {
        // Zorg ervoor dat de gebruiker is geauthenticeerd
        $userId = Auth::id();

        // Haal de studentgegevens op
        $student = Student::where('user_id', $userId)->first();
        $classId = $student->class_id;

        // Haal alle study_guide_ids op die bij de klas horen
        $studyGuideIds = DB::table('study_guides')
            ->where('class_id', $classId)
            ->pluck('id');

        // Query om het huiswerk op te halen op basis van study_guide_ids
        $homework = DB::table('homework')
            ->whereIn('study_guide_id', $studyGuideIds)
            ->orderBy('return_date')
            ->get();

        // Formatter voor de datum
        $locale = 'nl_NL';
        $formatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'Europe/Amsterdam',
            null,
            'd_MMMM_yyyy'
        );

        // Groepeer de resultaten op inleverdatum
        $groupedResults = [];
        foreach ($homework as $row) {
            $date = new DateTime($row->return_date);
            $inleverDate = $formatter->format($date);

            // Maak de eerste letter van de maand een hoofdletter en vervang spaties door underscores
            $inleverDateParts = explode('_', $inleverDate);
            if (isset($inleverDateParts[1])) {
                $inleverDateParts[1] = ucfirst($inleverDateParts[1]);
            }
            $inleverDate = implode('_', $inleverDateParts);

            $groupedResults[$inleverDate][] = $row;
        }

        // Return de gegevens in JSON-formaat
        return response()->json([
            'homework' => $groupedResults,
        ]);
    }

    // API Endpoint: Haal een specifiek huiswerk op basis van ID
    public function APIView($id)
    {
        // Haal huiswerk op basis van de unieke ID
        $homework = Homework::where('unique_id', $id)->first();

        // Controleer of het huiswerk behoort tot de ingelogde gebruiker
        if (!$homework || $homework->user_id != Auth::id()) {
            return response()->json([
                'error' => 'Homework not found or unauthorized access.',
            ], 403);
        }

        // Formatter voor de datum in de weergave
        $locale = 'nl_NL';
        $formatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'Europe/Amsterdam',
            null,
            'd_MMMM_yyyy'
        );

        // Format de inleverdatum van het specifieke huiswerk
        $date = new DateTime($homework->return_date);
        $homework->formatted_date = $formatter->format($date);

        // Haal andere huiswerktaken op voor de klas van de gebruiker
        $userId = Auth::id();
        $student = Student::where('user_id', $userId)->first();
        $classId = $student->class_id;
        $studyGuideIds = DB::table('study_guides')
            ->where('class_id', $classId)
            ->pluck('id');
        $groupedResults = Homework::whereIn('study_guide_id', $studyGuideIds)
            ->orderBy('return_date')
            ->get()
            ->groupBy(/**
             * @throws \Exception
             */ function ($item) use ($formatter) {
                $date = new DateTime($item->return_date);
                $formattedDate = $formatter->format($date);

                // Zorg ervoor dat de eerste letter van de maand een hoofdletter is en vervang spaties door underscores
                $formattedDateParts = explode('_', $formattedDate);
                if (isset($formattedDateParts[1])) {
                    $formattedDateParts[1] = ucfirst($formattedDateParts[1]);
                }

                return implode('_', $formattedDateParts);
            });

        // Return de gegevens in JSON-formaat
        return response()->json([
            'homework' => $homework,
        ]);
    }
}
