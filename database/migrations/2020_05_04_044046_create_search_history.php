<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('search_type');
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa');
            $table->unsignedBigInteger('id_tempat_pkl')->nullable();
            $table->foreign('id_tempat_pkl')->references('id')->on('tempat_pkl');
            $table->unsignedBigInteger('id_owner_history');
            $table->foreign('id_owner_history')->references('id')->on('mahasiswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_history');
    }
}
