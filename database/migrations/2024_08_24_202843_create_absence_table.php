<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenceTable extends Migration
{
    public function up()
    {
        Schema::create('absence', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('date');
            $table->string('unique_id');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('reason');
            $table->longText('remark')->default('Geen opmerking meegegeven.');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absence');
    }
}
