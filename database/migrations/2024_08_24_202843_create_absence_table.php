<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenceTable extends Migration
{
    public function up()
    {
        Schema::create('absence', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('gemaakt_date');
            $table->string('unique_id');
            $table->string('begintijd');
            $table->string('eindtijd');
            $table->string('reden');
            $table->longText('opmerking')->default('Geen opmerking meegegeven.');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absence');
    }
}
