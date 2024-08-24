<?php
namespace App\Http\Controllers;

use App\Models\Perm;
use App\Models\Org;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function checkUserMembership()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $userId = Auth::id(); // Get the user ID from the session

            // Check if the user is a member of a school
            $perm = Perm::where('user_id', $userId)->first();

            if ($perm) {
                $orgID = $perm->org_id;
                $permission = $perm->perm;

                // If the user has the "Docent" permission, redirect to docenten.flashlearn.nl
                if ($permission === 'Docent') {
                    return Redirect::to('https://docenten.flashlearn.nl')->send();
                }

                // Get the organization details
                $org = Org::find($orgID);

                if ($org) {
                    // Store the organization details in the session
                    Session::put('orgName', $org->name);
                    Session::put('org_id', $org->id);
                    Session::put('org_web', $org->website);

                    // You can now use these session variables as needed
                }
            }
        }
    }
}
