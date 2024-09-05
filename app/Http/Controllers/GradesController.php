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

        // Fetch grades for the selected subject
        $grades = DB::table('grades AS cijfers')
            ->join('subjects AS vakken', 'cijfers.vak_id', '=', 'vakken.id')
            ->where('cijfers.user_id', $userId)
            ->where('vakken.vak_naam', $vak)
            ->get();

        // Fetch subjects to display in the sidebar
        $subjects = DB::table('subjects')
            ->where('school_id', session('org_id'))
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Calculate the weighted average grades for each subject
        $averageGrades = [];
        foreach ($subjects as $subject) {
            $grades = DB::table('grades')
                ->where('vak_id', $subject->id)
                ->where('user_id', $userId)
                ->get(['grade', 'weight', 'onderdeel', 'created_at']);

            $totalWeight = $grades->sum('weight');
            $weightedSum = $grades->sum(function($grade) {
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
