<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('subject', ['Wiskunde','Biologie','Nederlands','NASK','Geschiedenis','Engels','Economie','Aardrijkskunde','K&C','Maatschappijleer','Informatica','Filosofie','L&G','Muziek','Techniek','Godsdienst/Levensbeschouwing','Frans','Duits','Spaans']);
            $table->string('title');
            $table->longText('content');
            $table->string('level');
            $table->string('unique_id');
            $table->unsignedBigInteger('user_id');
            $table->date('created_at');
            $table->date('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
