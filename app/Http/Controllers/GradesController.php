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

        // Calculate the average grades for each subject
        $averageGrades = [];
        foreach ($subjects as $subject) {
            $average = DB::table('grades')
                ->where('vak_id', $subject->id)
                ->where('user_id', $userId)
                ->avg('grade');

            $averageGrades[$subject->vak_naam] = $average;
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

        // Calculate the average grades for each subject
        $averageGrades = [];
        foreach ($subjects as $subject) {
            $average = DB::table('grades')
                ->where('vak_id', $subject->id)
                ->where('user_id', $userId)
                ->avg('grade');

            $averageGrades[$subject->vak_naam] = $average;
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

        // Log the userId and schoolId for debugging
        \Log::info("User ID: {$userId}, School ID: {$schoolId}");

        if (!$schoolId) {
            return response()->json(['error' => 'School ID not found for the user'], 404);
        }

        // Fetch the subjects related to the user's school
        $subjects = DB::table('subjects')
            ->where('school_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Log the number of subjects found
        \Log::info("Subjects found: " . $subjects->count());

        // Prepare an array to store grades data
        $gradesData = [];

        // Fetch grades for each subject
        foreach ($subjects as $subject) {
            \Log::info("Fetching grades for subject: {$subject->vak_naam}, Subject ID: {$subject->id}");

            $grades = DB::table('grades')
                ->where('vak_id', $subject->id)
                ->where('user_id', $userId)
                ->get();

            // Log the number of grades found
            \Log::info("Grades found for {$subject->vak_naam}: " . $grades->count());

            // Store grades in the gradesData array
            $gradesData[$subject->vak_naam] = $grades->toArray();
        }

        // Log the entire gradesData array for debugging
        \Log::info("Grades Data: " . json_encode($gradesData));

        // Return the grades data as JSON response
        return response()->json([
            'grades' => $gradesData
        ]);
    }


}
