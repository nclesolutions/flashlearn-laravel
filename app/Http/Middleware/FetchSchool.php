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
            // Query om te controleren of de gebruiker een student is en bij een school hoort
            $membership = DB::table('students')
                ->where('user_id', $user->id)
                ->first();

            if ($membership) {
                // Query om schoolgegevens op te halen
                $school = DB::table('schools')
                    ->where('id', $membership->org_id)  // Gebruik de 'id' van de school
                    ->first();

                if ($school) {
                    // Schoolinformatie opslaan in de sessie
                    session([
                        'orgName' => $school->name,
                        'org_id' => $school->id,  // Gebruik de 'id' van de school
                        'org_web' => $school->website,
                    ]);
                }
            }
        }

        return $next($request);
    }
}
