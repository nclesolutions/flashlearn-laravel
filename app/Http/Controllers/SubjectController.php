<?php
namespace App\Http\Controllers;

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

        // Stuur het geselecteerde vak, alle vakken, en de huiswerkopdrachten door naar de view
        return view('dashboard.subjects.view', compact('selectedSubject', 'subjects'));
    }
}
