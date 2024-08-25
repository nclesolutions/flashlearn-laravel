<?php
namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Assignment;
use App\Models\Schedule;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        // Tel het aantal huiswerkopdrachten voor de gebruiker
        $huiswerkCount = Homework::where('user_id', $userId)->count();

        // Tel het aantal werkstukken voor de gebruiker
        $werkstukCount = Assignment::where('owner_id', $userId)->count();

        // Haal de werkstukken van de gebruiker op
        $werkstukken = Assignment::where('owner_id', $userId)->get();

        // Haal de laatste 3 cijfers op voor de gebruiker
        $cijfers = Grade::select('grades.vak_id', 'grades.grade', 'subjects.vak_naam', 'grades.onderdeel', 'grades.date_created')
            ->join('subjects', 'grades.vak_id', '=', 'subjects.id')
            ->where('grades.user_id', $userId)
            ->orderBy('grades.date_created', 'desc')
            ->limit(3)
            ->get();

        // Haal het weeknummer uit het verzoek op, of gebruik de huidige week
        $weekNumber = $request->query('week', date('W'));

        // Haal het rooster op voor de huidige week
        $schedule = Schedule::where('user_id', $userId)->first();

        if ($schedule) {
            $roosters = json_decode($schedule->roosters, true);
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
}
