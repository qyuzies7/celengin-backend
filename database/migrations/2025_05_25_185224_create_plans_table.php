<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedBigInteger('pengguna_id');
            $table->string('periode_type', 16);
            $table->date('periode_start');
            $table->date('periode_end');
            $table->string('nominal', 512);
            $table->timestamps();

            $table->foreign('pengguna_id')->references('id')->on('penggunas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}