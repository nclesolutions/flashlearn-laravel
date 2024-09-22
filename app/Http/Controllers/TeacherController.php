<?php
namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Assignment;
use App\Models\Schedule;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        // Zorg ervoor dat de gebruiker is geauthenticeerd
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Haal het ID van de huidige geauthenticeerde gebruiker op
        $userId = Auth::id();

        return view('teacher.home.index');
    }

}
