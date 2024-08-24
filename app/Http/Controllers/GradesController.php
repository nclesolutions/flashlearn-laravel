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
        $subjects = DB::table('tbl_vakken')
            ->where('school_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Calculate the average grades for each subject
        $averageGrades = [];
        foreach ($subjects as $subject) {
            $average = DB::table('tbl_cijfers')
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

        // Fetch grades for the selected subject
        $grades = DB::table('tbl_cijfers AS cijfers')
            ->join('tbl_vakken AS vakken', 'cijfers.vak_id', '=', 'vakken.id')
            ->where('cijfers.user_id', $userId)
            ->where('vakken.vak_naam', $vak)
            ->get();

        // Fetch subjects to display in the sidebar
        $subjects = DB::table('tbl_vakken')
            ->where('school_id', session('org_id'))
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Calculate the average grades for each subject
        $averageGrades = [];
        foreach ($subjects as $subject) {
            $average = DB::table('tbl_cijfers')
                ->where('vak_id', $subject->id)
                ->where('user_id', $userId)
                ->avg('grade');

            $averageGrades[$subject->vak_naam] = $average;
        }

        return view('dashboard.grades.view', compact('grades', 'vak', 'subjects', 'averageGrades'));
    }


}
