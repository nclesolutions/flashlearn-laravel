<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use App\Models\Perm;
use App\Models\Org;
use Illuminate\Support\ServiceProvider;

class UserMembershipServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Ensure the user is authenticated
        if (Auth::check()) {
            $userId = Auth::id();

            // Check if the user is a member of a school
            $perm = Perm::where('user_id', $userId)->first();

            if ($perm) {
                $orgID = $perm->org_id;
                $permission = $perm->perm;

                // If the user has the "Docent" permission, redirect to docenten.flashlearn.nl
                if ($permission === 'Docent') {
                    redirect()->to('https://docenten.flashlearn.nl')->send();
                    exit;
                }

                // Get the organization details
                $org = Org::find($orgID);

                if ($org) {
                    // Store the organization details in the session
                    Session::put('orgName', $org->name);
                    Session::put('org_id', $org->id);
                    Session::put('org_web', $org->website);
                }
            }
        }
    }
}
