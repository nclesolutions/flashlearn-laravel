<?php

namespace App\Http\Controllers;

use App\Mail\LoginNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        if (Auth::check()) {
            // Redirect to the home page if the user is already logged in
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // Handle the login process
    // Handle the login process
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Check if the account is activated
            if (config('auth.account_activation') && $user->activation_code !== 'activated') {
                return redirect()->back()->withErrors(['error' => 'Activeer je account om in te loggen!']);
            } elseif (1 + 1 == 3) {
                return redirect()->route('maintenance');
            } elseif (config('auth.account_approval') && !$user->approved) {
                return redirect()->back()->withErrors(['error' => 'Je account is nog niet goedgekeurd!']);
            } else {
                // Log the user in
                Auth::login($user);

                $user = Auth::user();
                $ipAddress = $request->ip();
                $time = now()->toDateTimeString();


                // Handle "remember me" functionality
                if ($request->filled('remember_me')) {
                    $cookie_hash = $user->remember_me_code ?: Hash::make($user->id . $user->username . config('app.key'));
                    $days = 30;
                    cookie()->queue('remember_me', $cookie_hash, $days * 1440); // 1440 minutes per day
                    $user->update(['remember_me_code' => $cookie_hash]);
                }

                // Update last seen date
                $user->update(['last_seen' => now()]);

                // Redirect to the dashboard
                return redirect()->intended('/'); // this will redirect to the intended page or localhost/
            }
        }

        return redirect()->back()->withErrors(['error' => 'Je e-mailadres of wachtwoord is onjuist!']);
    }



    // Show the registration form
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            // Redirect to the home page if the user is already logged in
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    // Handle the registration process
    public function register(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|alpha_num|max:255',
            'lastname' => 'required|alpha_num|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:20|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate a username and activation code
        $username = strtolower($request->input('firstname') . $request->input('lastname') . rand(1000, 9999));
        $activation_code = config('auth.account_activation') ? hash('sha256', uniqid() . $request->input('email') . config('app.key')) : 'activated';

        // Create the new user
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $username,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'activation_code' => $activation_code,
            'registered' => now(),
            'last_seen' => now(),
            'approved' => config('auth.account_approval') ? 0 : 1,
        ]);

        $user->assignRole('Gebruiker');

        // Send the email verification notification
        $user->sendEmailVerificationNotification();

        return redirect()->route('login')->with('success', 'Bekijk je e-mailadres om je account te activeren!');
    }


    public function showForgotPasswordForm()
    {
        if (Auth::check()) {
            // Redirect to the home page if the user is already logged in
            return redirect()->route('dashboard');
        }
        return view('auth.passwords.email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            // Manually create the password reset token
            $token = Str::random(60);

            // Store the token in the password_resets table
            Password::getRepository()->create($user);

            // Send the custom password reset notification
            $user->sendPasswordResetNotification($token);

            return back()->with(['status' => __('passwords.sent')]);
        } else {
            return back()->withErrors(['email' => __('We can\'t find a user with that email address.')]);
        }
    }


    // Show the reset password form
    public function showResetForm(Request $request, $token = null)
    {
        if (Auth::check()) {
            // Redirect to the home page if the user is already logged in
            return redirect()->route('home');
        }
        if (!$token) {
            return redirect()->route('password.request');
        }

        return view('auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }


    // Handle the reset password logic
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


    public function showBlocked()
    {
        return view('auth.blocked');
    }
    public function showMaintenance()
    {
        return view('auth.maintenance');
    }
}
