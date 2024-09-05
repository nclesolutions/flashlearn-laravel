<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoostersTable extends Migration
{
    public function up()
    {
        Schema::create('roosters', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->longText('roosters')->charset('utf8mb4')->collation('utf8mb4_bin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roosters');
    }
}
