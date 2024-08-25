<?php
namespace App\Http\Controllers;

use App\Models\Rooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        // Haal het school ID van de ingelogde gebruiker op
        $schoolId = session('org_id');

        // Haal alle vakken op met de gerelateerde leraar en gebruiker
        $subjects = Subject::with(['teacher.user'])
            ->where('school_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Stuur de vakken door naar de view
        return view('dashboard.subjects.index', compact('subjects'));
    }

    public function view($vak)
    {
        $schoolId = session('org_id');
        $userId = Auth::id();
        $currentWeek = now()->weekOfYear;

        // Haal het geselecteerde vak op met de gerelateerde leraar en gebruiker
        $selectedSubject = Subject::with(['teacher.user', 'homework'])
            ->where('school_id', $schoolId)
            ->where('vak_naam', $vak)
            ->first();

        // Controleer of het vak gevonden is
        if (!$selectedSubject) {
            abort(404, 'Subject not found');
        }

        // Haal alle vakken op om in de zijbalk te tonen
        $subjects = Subject::with(['teacher.user'])
            ->where('school_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Haal het rooster van de gebruiker op
        $rooster = Rooster::where('user_id', $userId)->first();

        // Veronderstel dat het rooster opgeslagen is in een JSON-formaat zoals het voorbeeld dat je gaf
        $roosterData = json_decode($rooster->roosters, true);

        // Filter de lessen van het geselecteerde vak voor de huidige week
        $filteredLessons = [];
        foreach ($roosterData['weeks'] as $week) {
            if ($week['week_number'] == $currentWeek) {
                foreach ($week['days'] as $day) {
                    foreach ($day['schedule'] as $lesson) {
                        if (strtolower($lesson['lesson']) == strtolower($vak)) {
                            $filteredLessons[$day['day_of_week']][] = $lesson;
                        }
                    }
                }
            }
        }

        // Maak een array voor de dagen van de week (Maandag t/m Vrijdag)
        $dagen = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag'];

        // Stuur het geselecteerde vak, gefilterde lessen, en de dagen door naar de view
        return view('dashboard.subjects.view', compact('selectedSubject', 'filteredLessons', 'dagen', 'subjects'));
    }

}
