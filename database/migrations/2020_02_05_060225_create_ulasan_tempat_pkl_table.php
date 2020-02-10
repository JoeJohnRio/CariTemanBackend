<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasanTempatPklTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulasan_tempat_pkl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ulasan');
            $table->unsignedBigInteger('id_tempat_pkl');
            $table->foreign('id_tempat_pkl')->references('id')->on('tempat_pkl');
            $table->unsignedBigInteger('id_pengirim');
            $table->foreign('id_pengirim')->references('id')->on('mahasiswa');
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
        Schema::dropIfExists('ulasan_tempat_pkl');
    }
}
