<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekomendasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekomendasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jumlah_rating');
            $table->string('deskripsi');
            $table->unsignedBigInteger('id_pengirim');
            $table->foreign('id_pengirim')->references('id')->on('mahasiswa');
            $table->unsignedBigInteger('id_penerima');
            $table->foreign('id_penerima')->references('id')->on('mahasiswa');
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
        Schema::dropIfExists('rekomendasi');
    }
}
