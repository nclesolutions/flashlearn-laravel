<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerificationController extends Controller
{
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return auth()->user()->hasVerifiedEmail()
            ? redirect()->route('dashboard')
            : view('auth.verify');
    }

    public function verify(Request $request)
    {
        // Get the user by ID
        $user = User::findOrFail($request->route('id'));

        // Check if the hash matches
        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect()->route('login')->withErrors(['error' => 'Deze verificatielink is niet geldig!']);
        }

        // Check if the email is already verified
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('success', 'Je e-mailadres is al geverifieerd.');
        }

        // Mark the email as verified
        $user->markEmailAsVerified();

        return redirect()->route('login')->with('success', 'Je e-mailadres is succesvol geverifieerd.');
    }

    public function resend(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
