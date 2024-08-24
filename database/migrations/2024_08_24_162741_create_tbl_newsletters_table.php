<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNewslettersTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->timestamps();

            $table->foreign('school_id')->references('org_id')->on('tbl_orgs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_newsletters');
    }
}
