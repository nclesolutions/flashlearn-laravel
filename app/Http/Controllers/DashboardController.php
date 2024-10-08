<?php
namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Assignment;
use App\Models\Schedule;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Zorg ervoor dat de gebruiker is geauthenticeerd
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Haal het ID van de huidige geauthenticeerde gebruiker op
        $userId = Auth::id();

        // Haal de studentgegevens van de ingelogde gebruiker op
        $student = Student::where('user_id', $userId)->first();

// Haal de user_id van de ingelogde gebruiker en class_id van de student op
        $userId = Auth::id();
        $student = Student::where('user_id', $userId)->first();
        $classId = $student->class_id;

// Haal alle study_guide_ids op die bij de klas horen
        $studyGuideIds = DB::table('study_guides')
            ->where('class_id', $classId)
            ->pluck('id');

// Tel het aantal huiswerkopdrachten voor de gebruiker, gebaseerd op study_guide_id
        $huiswerkCount = Homework::whereIn('study_guide_id', $studyGuideIds)->count();
        // Tel het aantal werkstukken voor de gebruiker
        $werkstukCount = Assignment::where('user_id', $userId)->count();

        // Haal de werkstukken van de gebruiker op
        $werkstukken = Assignment::where('user_id', $userId)->get();

        // Haal de laatste 3 cijfers op voor de gebruiker
        $cijfers = Grade::select('grades.subject_id', 'grades.grade', 'subjects.name', 'grades.part', 'grades.date_created')
            ->join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->where('grades.user_id', $userId)
            ->orderBy('grades.date_created', 'desc')
            ->limit(3)
            ->get();

        // Haal het weeknummer uit het verzoek op, of gebruik de huidige week
        $weekNumber = $request->query('week', date('W'));

        // Haal het rooster op voor de huidige week
        $schedule = Schedule::where('class_id', $student->class_id)->first();

        if ($schedule) {
            $roosters = json_decode($schedule->data, true);
            $currentWeekRooster = collect($roosters['weeks'])->firstWhere('week_number', $weekNumber);

            if ($currentWeekRooster) {
                // Vervang de 'teacher' ID door de bijbehorende naam uit de teachers tabel
                foreach ($currentWeekRooster['days'] as &$day) {
                    foreach ($day['schedule'] as &$lesson) {
                        $teacher = Teacher::with('user')->find($lesson['teacher']);
                        if ($teacher && $teacher->user) {
                            $lesson['teacher'] = strtoupper(substr($teacher->user->firstname, 0, 1)) . '. ' . $teacher->user->lastname;
                        }
                    }
                }
            }

            // Haal de volgende en vorige weken op
            $weeks = $roosters['weeks'];
            $currentWeekIndex = array_search($currentWeekRooster, $weeks);
            $nextWeek = $weeks[$currentWeekIndex + 1] ?? null;
            $prevWeek = $weeks[$currentWeekIndex - 1] ?? null;
        } else {
            $currentWeekRooster = ['days' => []];
            $nextWeek = null;
            $prevWeek = null;
            $weeks = [];
        }

        return view('dashboard.index', compact('huiswerkCount', 'cijfers', 'werkstukCount', 'currentWeekRooster', 'nextWeek', 'prevWeek', 'weeks', 'weekNumber', 'werkstukken'));
    }

    // API Endpoint: Haal dashboardgegevens op voor de ingelogde gebruiker
    public function APIIndex(Request $request)
    {
        // Zorg ervoor dat de gebruiker is geauthenticeerd
        $userId = Auth::id();

        // Haal de studentgegevens van de ingelogde gebruiker op
        $student = Student::where('user_id', $userId)->first();

        // Tel het aantal huiswerkopdrachten voor de student
        $huiswerkCount = Homework::where('user_id', $userId)->count();

        // Tel het aantal werkstukken voor de student
        $werkstukCount = Assignment::where('user_id', $userId)->count();

        // Haal de werkstukken van de student op
        $werkstukken = Assignment::where('user_id', $userId)->get();

        // Haal de laatste 3 cijfers op voor de student
        $cijfers = Grade::select('grades.subject_id', 'grades.grade', 'subjects.name as subject_name', 'grades.part', 'grades.created_at as date_created')
            ->join('subjects', 'grades.subject_id', '=', 'subjects.id')
            ->where('grades.user_id', $userId)
            ->orderBy('grades.created_at', 'desc')
            ->limit(3)
            ->get();

        // Haal het weeknummer uit het verzoek op, of gebruik de huidige week
        $weekNumber = $request->query('week', date('W'));

        // Haal het rooster op voor de huidige week
        $schedule = Schedule::where('class_id', $student->class_id)->first();

        if ($schedule) {
            $roosters = json_decode($schedule->data, true);
            $currentWeekRooster = collect($roosters['weeks'])->firstWhere('week_number', $weekNumber);

            if ($currentWeekRooster) {
                // Vervang de 'teacher' ID door de bijbehorende naam uit de teachers tabel
                foreach ($currentWeekRooster['days'] as &$day) {
                    foreach ($day['schedule'] as &$lesson) {
                        $teacher = Teacher::with('user')->find($lesson['teacher']);
                        if ($teacher && $teacher->user) {
                            $lesson['teacher'] = strtoupper(substr($teacher->user->firstname, 0, 1)) . '. ' . $teacher->user->lastname;
                        }
                    }
                }
            }

            // Haal de volgende en vorige weken op
            $weeks = $roosters['weeks'];
            $currentWeekIndex = array_search($currentWeekRooster, $weeks);
            $nextWeek = $weeks[$currentWeekIndex + 1] ?? null;
            $prevWeek = $weeks[$currentWeekIndex - 1] ?? null;
        } else {
            $currentWeekRooster = ['days' => []];
            $nextWeek = null;
            $prevWeek = null;
            $weeks = [];
        }

        return response()->json([
            'currentWeekRooster' => $currentWeekRooster,
            'weeks' => $weeks,
            'weekNumber' => $weekNumber,
        ]);
    }
}
