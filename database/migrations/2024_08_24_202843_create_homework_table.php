<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    public function up()
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('inlever_date');
            $table->string('unique_id');
            $table->string('vak');
            $table->string('title');
            $table->text('beschrijving')->default('Geen beschrijving meegegeven.');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('homework');
    }
}
