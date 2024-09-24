<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashcardsTable extends Migration
{
    public function up()
    {
        Schema::create('flashcards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subject_id');
            $table->string('question');
            $table->string('answer');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    public function down()
    {
        Schema::dropIfExists('flashcards');
    }
}
