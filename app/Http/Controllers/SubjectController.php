<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        // Get the logged-in user's school ID
        $schoolId = session('org_id');

        // Retrieve subjects with the related teacher and user
        $subjects = Subject::with(['teacher.user'])
            ->where('school_id', $schoolId)
            ->orderBy('gekregen_date', 'asc')
            ->get();

        // Pass the subjects data to the view
        return view('dashboard.subjects.index', compact('subjects'));
    }
}
