<?php
namespace App\Http\Controllers;

use App\Models\Rooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        // Haal het school ID van de ingelogde gebruiker op
        $schoolId = session('org_id');

        // Haal alle vakken op met de gerelateerde leraar en gebruiker
        $subjects = Subject::with(['teacher.user'])
            ->where('org_id', $schoolId)
            ->orderBy('created_at', 'asc')
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
            ->where('org_id', $schoolId)
            ->where('name', $vak)
            ->first();

        // Controleer of het vak gevonden is
        if (!$selectedSubject) {
            abort(404, 'Subject not found');
        }

        // Haal alle vakken op om in de zijbalk te tonen
        $subjects = Subject::with(['teacher.user'])
            ->where('org_id', $schoolId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Haal de klas van de ingelogde gebruiker op
        $studentClass = Student::where('user_id', $userId)
            ->value('class_id');

        // Haal het rooster van de klas van de gebruiker op
        $rooster = Rooster::where('class_id', $studentClass)->first();

        if ($rooster) {
            $roosterData = json_decode($rooster->data, true);

            // Filter de lessen van het geselecteerde vak voor de huidige week en vervang de teacher ID door de naam
            $filteredLessons = [];
            foreach ($roosterData['weeks'] as $week) {
                if ($week['week_number'] == $currentWeek) {
                    foreach ($week['days'] as $day) {
                        foreach ($day['schedule'] as $lesson) {
                            if (strtolower($lesson['lesson']) == strtolower($vak)) {
                                // Vervang de 'teacher' ID door de bijbehorende naam
                                $teacher = Teacher::with('user')->find($lesson['teacher']);
                                if ($teacher && $teacher->user) {
                                    $lesson['teacher'] = strtoupper(substr($teacher->user->firstname, 0, 1)) . '. ' . $teacher->user->lastname;
                                }
                                $filteredLessons[$day['day_of_week']][] = $lesson;
                            }
                        }
                    }
                }
            }
        } else {
            $filteredLessons = [];
        }

        // Maak een array voor de dagen van de week (Maandag t/m Vrijdag)
        $dagen = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag'];

        // Stuur het geselecteerde vak, gefilterde lessen, en de dagen door naar de view
        return view('dashboard.subjects.view', compact('selectedSubject', 'filteredLessons', 'dagen', 'subjects'));
    }

    public function APIIndex()
    {
        // Haal het ID van de ingelogde leerling op
        $userId = Auth::id();

        // Haal het school ID van de leerling op uit de database
        $schoolId = DB::table('students')
            ->where('user_id', $userId)
            ->value('org_id');

        if (!$schoolId) {
            return response()->json(['error' => 'School ID not found'], 404);
        }

        // Haal alle vakken op die aan de school van de leerling zijn gekoppeld
        $subjects = Subject::with(['teacher' => function ($query) {
            $query->select('id', 'user_id', 'org_id', 'perm'); // Selecteer alleen de benodigde velden van teacher
        }, 'teacher.user' => function ($query) {
            $query->select('id', 'firstname', 'lastname'); // Selecteer alleen de benodigde velden van user
        }])
            ->where('org_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get(['id', 'org_id', 'teacher_id', 'gekregen_date', 'name']); // Selecteer alleen de benodigde velden van subject

        // Return the subjects as a JSON response
        return response()->json(['subjects' => $subjects]);
    }
}
