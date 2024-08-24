<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Haal de accountgegevens op
        $account = Auth::user();

        // Haal de biografie van de gebruiker op
        $biography = DB::table('users')
            ->where('id', $account->id)
            ->value('biography');

        // Haal de org_id (school_id) van de gebruiker op
        $userSchoolId = DB::table('students')
            ->where('user_id', $account->id) // Gebruik $account->id in plaats van $account
            ->value('org_id');

        // Haal de schoolinformatie op als de gebruiker aan een school gekoppeld is
        $schoolInfo = null;
        if ($userSchoolId) {
            $schoolInfo = DB::table('schools')
                ->where('org_id', $userSchoolId)
                ->first();
        }

        // Pass gegevens naar de view
        return view('dashboard.account.index', [
            'account' => $account,
            'biography' => $biography,
            'schoolInfo' => $schoolInfo,
        ]);
    }
}
