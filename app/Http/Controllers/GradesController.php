<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradesController extends Controller
{
    public function index()
    {
        // Get the logged-in user's ID
        $userId = Auth::id();
        $schoolId = session('org_id');

        // Fetch the subjects related to the user's school
        $subjects = DB::table('subjects')
            ->where('school_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Calculate the weighted average grades for each subject
        $averageGrades = [];
        foreach ($subjects as $subject) {
            $grades = DB::table('grades')
                ->where('vak_id', $subject->id)
                ->where('user_id', $userId)
                ->get(['grade', 'weight']);

            $totalWeight = $grades->sum('weight');
            $weightedSum = $grades->sum(function($grade) {
                return $grade->grade * $grade->weight;
            });

            $averageGrades[$subject->vak_naam] = $totalWeight > 0 ? $weightedSum / $totalWeight : null;
        }

        return view('dashboard.grades.index', compact('subjects', 'averageGrades'));
    }

    public function view($vak)
    {
        $userId = Auth::id();
        $schoolId = session('org_id');

        // Haal het vak op basis van de naam
        $subject = DB::table('subjects')
            ->where('vak_naam', $vak)
            ->where('school_id', $schoolId)
            ->first();

        if (!$subject) {
            return abort(404, 'Vak niet gevonden');
        }

        // Gebruik het vak-ID om de cijfers op te halen
        $grades = DB::table('grades')
            ->where('vak_id', $subject->id)
            ->where('user_id', $userId)
            ->get();

        // Haal alle vakken op voor de sidebar
        $subjects = DB::table('subjects')
            ->where('school_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Bereken het gemiddelde voor elk vak
        $averageGrades = [];
        foreach ($subjects as $subject) {
            $subjectGrades = DB::table('grades')
                ->where('vak_id', $subject->id)
                ->where('user_id', $userId)
                ->get();

            $totalWeight = $subjectGrades->sum('weight');
            $weightedSum = $subjectGrades->sum(function($grade) {
                return $grade->grade * $grade->weight;
            });

            $averageGrades[$subject->vak_naam] = $totalWeight > 0 ? $weightedSum / $totalWeight : null;
        }

        return view('dashboard.grades.view', compact('grades', 'vak', 'subjects', 'averageGrades'));
    }

    public function APIIndex()
    {
        // Get the logged-in user's ID
        $userId = Auth::id();

        // Fetch the org_id (school_id) from the students table using the user ID
        $schoolId = DB::table('students')
            ->where('user_id', $userId)
            ->value('org_id');

        if (!$schoolId) {
            return response()->json(['error' => 'School ID not found for the user'], 404);
        }

        $subjects = DB::table('subjects')
            ->where('school_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get();

        $gradesData = [];

        // Fetch grades and calculate weighted averages for each subject
        foreach ($subjects as $subject) {
            $grades = DB::table('grades')
                ->where('vak_id', $subject->id)
                ->where('user_id', $userId)
                ->get(['grade', 'weight', 'onderdeel', 'created_at']); // Selecteer 'onderdeel' en 'created_at'

            $totalWeight = $grades->sum('weight');
            $weightedSum = $grades->sum(function($grade) {
                return $grade->grade * $grade->weight;
            });

            $weightedAverage = $totalWeight > 0 ? $weightedSum / $totalWeight : null;

            // Store grades and the weighted average in the gradesData array
            $gradesData[$subject->vak_naam] = [
                'grades' => $grades->toArray(),
                'weighted_average' => $weightedAverage
            ];
        }

        return response()->json(['grades' => $gradesData]);
    }

}
