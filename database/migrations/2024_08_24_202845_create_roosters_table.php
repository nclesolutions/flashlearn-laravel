<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoostersTable extends Migration
{
    public function up()
    {
        Schema::create('roosters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_id');
            $table->longText('data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roosters');
    }
}
