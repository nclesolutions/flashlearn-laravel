<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckUserMembership
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Query to check if the user is a member of a school
            $membership = DB::table('tbl_perms')
                ->where('user_id', $user->id)
                ->first();

            if ($membership) {
                // Check if the user has "Docent" permission
                if ($membership->perm === 'Docent') {
                    return redirect()->away('https://docenten.flashlearn.nl');
                }

                // Query to get school details
                $school = DB::table('tbl_orgs')
                    ->where('org_id', $membership->org_id)
                    ->first();

                if ($school) {
                    // Store school information in session
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
