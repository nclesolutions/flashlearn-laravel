<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            ->where('user_id', Auth::id()) // Gebruik $account->id in plaats van $account
            ->value('org_id');

        // Haal de schoolinformatie op als de gebruiker aan een school gekoppeld is
        $schoolInfo = null;
        if ($userSchoolId) {
            $schoolInfo = DB::table('schools')
                ->where('id', $userSchoolId)
                ->first();
        }

        // Pass gegevens naar de view
        return view('dashboard.account.index', [
            'account' => $account,
            'biography' => $biography,
            'schoolInfo' => $schoolInfo,
        ]);
    }

    public function security()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Haal de accountgegevens op
        $account = Auth::user();

        // Haal de biografie van de gebruiker op
        $biography = DB::table('users')
            ->where('id', Auth::id())
            ->value('biography');

        // Haal de org_id (school_id) van de gebruiker op
        $userSchoolId = DB::table('students')
            ->where('user_id', Auth::id()) // Gebruik $account->id in plaats van $account
            ->value('org_id');

        // Haal de schoolinformatie op als de gebruiker aan een school gekoppeld is
        $schoolInfo = null;
        if ($userSchoolId) {
            $schoolInfo = DB::table('schools')
                ->where('id', $userSchoolId)
                ->first();
        }

        // Pass gegevens naar de view
        return view('dashboard.account.security', [
            'account' => $account,
            'biography' => $biography,
            'schoolInfo' => $schoolInfo,
        ]);
    }
    public function updateSecurity(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id, // Ensure email is unique but ignore the current user's email
            'current_password' => 'required', // Old password is required
            'new_password' => 'nullable|min:8', // New password must be confirmed
        ]);

        // Verify the current password matches the one stored in the database
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Het huidige wachtwoord is onjuist.']);
        }

        // Update the email if it's changed
        if ($user->email !== $request->input('email')) {
            $user->email = $request->input('email');
        }

        // Update the password if a new one is provided
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        // Save the updated user information
        $user->save();

        // Redirect with success message
        return redirect()->route('profile.security')->with('status', [
            'title' => 'Gelukt!',
            'message' => 'Je beveiligingsinstellingen zijn bijgewerkt!',
            'type' => 'success',
        ]);
    }

    public function updateBio(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the biography input
        $request->validate([
            'biography' => 'required|max:1000',
        ]);

        // Update biography
        $user->biography = $request->input('biography');
        $user->save();  // Save the changes

        // Redirect with a success message
        return redirect()->route('profile.settings')->with('status', [
            'title' => 'Gelukt!',
            'message' => 'Je biografie is bijgewerkt!',
            'type' => 'success',
        ]);
    }

    public function settings()
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
            ->where('user_id', Auth::id()) // Gebruik $account->id in plaats van $account
            ->value('org_id');

        // Haal de schoolinformatie op als de gebruiker aan een school gekoppeld is
        $schoolInfo = null;
        if ($userSchoolId) {
            $schoolInfo = DB::table('schools')
                ->where('id', $userSchoolId)
                ->first();
        }

        // Pass gegevens naar de view
        return view('dashboard.account.settings', [
            'account' => $account,
            'biography' => $biography,
            'schoolInfo' => $schoolInfo,
        ]);
    }

    // API Endpoint: Haal profielgegevens op voor de ingelogde gebruiker
    public function APIIndex()
    {
        // Zorg ervoor dat de gebruiker is geauthenticeerd
        $account = Auth::user();

        // Haal de biografie van de gebruiker op
        $biography = DB::table('users')
            ->where('id', $account->id)
            ->value('biography');

        // Haal de org_id (school_id) van de gebruiker op
        $userSchoolId = DB::table('students')
            ->where('user_id', Auth::id())
            ->value('org_id');

        // Haal de schoolinformatie op als de gebruiker aan een school gekoppeld is
        $schoolInfo = null;
        if ($userSchoolId) {
            $schoolInfo = DB::table('schools')
                ->where('id', $userSchoolId)
                ->first();
        }

        // Return de gegevens in JSON-formaat
        return response()->json([
            'account' => $account,
        ]);
    }
}
