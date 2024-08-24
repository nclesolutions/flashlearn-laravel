<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    public function index()
    {
        // User ID
        $userId = auth()->user()->id;

        setlocale(LC_TIME, 'nl_NL.UTF-8');
        \Carbon\Carbon::setLocale('nl');

        // Haal de org_id (school_id) van de gebruiker op
        $userSchoolId = DB::table('students')
            ->where('user_id', $userId)
            ->value('org_id');

        // Haal de schoolinformatie op als de gebruiker aan een school gekoppeld is
        $schoolInfo = null;
        if ($userSchoolId) {
            $schoolInfo = DB::table('schools')
                ->where('org_id', $userSchoolId)
                ->first();
        }

        // Haal school-specifieke nieuwsbrieven op, gesorteerd op created_at en beperkt tot 1
        $schoolNewsletters = DB::table('newsletters')
            ->join('users', 'newsletters.creator', '=', 'users.id') // Verbind de creator met de user tabel
            ->where('school_id', $userSchoolId)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->select('newsletters.*', 'users.firstname', 'users.lastname') // Selecteer de gewenste velden
            ->get();

        // Haal algemene nieuwsbrieven op (school_id is NULL), gesorteerd op created_at en beperkt tot 3
        $generalNewsletters = DB::table('newsletters')
            ->join('users', 'newsletters.creator', '=', 'users.id') // Verbind de creator met de user tabel
            ->whereNull('school_id')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->select('newsletters.*', 'users.firstname', 'users.lastname') // Selecteer de gewenste velden
            ->get();

        // Combineer school-specifieke en algemene nieuwsbrieven
        if (!$userSchoolId) {
            $newsletters = $generalNewsletters;
        } else {
            // Combineer school-specifieke en algemene nieuwsbrieven, en haal er max 3 op
            $newsletters = $schoolNewsletters->merge($generalNewsletters)->sortByDesc('created_at')->take(3);
        }

        return view('dashboard.school.index', [
            'newsletters' => $newsletters,
            'schoolInfo' => $schoolInfo
        ]);
    }
}
