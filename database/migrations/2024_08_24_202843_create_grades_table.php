<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('user_id');
            $table->string('grade', 3);
            $table->string('part');
            $table->decimal('weight', 5, 2)->default(1.00);
            $table->date('date_created')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
