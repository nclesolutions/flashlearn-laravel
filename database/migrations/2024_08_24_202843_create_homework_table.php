<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    public function up()
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('return_date');
            $table->string('unique_id');
            $table->string('subject');
            $table->string('title');
            $table->text('description')->default('Geen beschrijving meegegeven.');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('homework');
    }
}
