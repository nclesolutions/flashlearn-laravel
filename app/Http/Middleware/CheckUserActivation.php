<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserActivation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user's account is deactivated
            if ($user->activation_code == 'deactivated') {
                // Redirect to the 'blocked' route
                return redirect()->route('blocked');
            }
        }

        // If everything is fine, proceed with the request
        return $next($request);
    }
}
