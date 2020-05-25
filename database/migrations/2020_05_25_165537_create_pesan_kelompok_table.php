<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_kelompok', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->string('isi_pesan');
            $table->unsignedBigInteger('id_mahasiswa_pengirim');
            $table->foreign('id_mahasiswa_pengirim')->references('id')->on('mahasiswa');
            $table->unsignedBigInteger('id_kelompok');
            $table->foreign('id_kelompok')->references('id')->on('kelompok');
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
        Schema::dropIfExists('pesan_kelompok');
    }
}
