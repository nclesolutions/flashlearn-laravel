<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function show()
    {

        if (!Auth::check()) {
            // Redirect to the home page if the user is already logged in
            return redirect()->route('login');
        }

        return auth()->user()->hasVerifiedEmail()
            ? redirect()->route('dashboard')
            : view('auth.verify');
    }

    public function verify(EmailVerificationRequest $request)
    {
        // Controleer of de gebruiker is ingelogd
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->fulfill();

        return redirect()->route('dashboard');
    }

    public function resend(Request $request)
    {
        // Controleer of de gebruiker is ingelogd
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
