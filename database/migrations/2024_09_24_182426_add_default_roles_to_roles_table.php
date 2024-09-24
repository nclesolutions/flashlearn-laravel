<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class AddDefaultRolesToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Voeg standaardrollen in de roles-tabel in
        Role::create(['name' => 'Administrator', 'guard_name' => 'superadmin']);
        Role::create(['name' => 'ICT', 'guard_name' => 'superadmin']);
        Role::create(['name' => 'Gebruiker', 'guard_name' => 'web']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Verwijder de standaardrollen
        Role::where('name', 'Administrator')->delete();
        Role::where('name', 'Gebruiker')->delete();
    }
}
