<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FetchSchool
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Query om te controleren of de gebruiker lid is van een school
            $membership = DB::table('students')
                ->where('user_id', $user->id)
                ->first();

            if ($membership) {
                // Query om schoolgegevens op te halen
                $school = DB::table('schools')
                    ->where('org_id', $membership->org_id)
                    ->first();

                if ($school) {
                    // Schoolinformatie opslaan in de sessie
                    session([
                        'orgName' => $school->name,
                        'org_id' => $school->org_id,
                        'org_web' => $school->website,
                    ]);
                }
            }
        }

        return $next($request);
    }
}
