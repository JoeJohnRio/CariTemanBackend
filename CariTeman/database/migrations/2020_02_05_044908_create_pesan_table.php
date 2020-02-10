<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pesan');
            $table->timestamp('waktu_terkirim');
            $table->integer('id_penerima_kelompok')->nullable();
            $table->unsignedBigInteger('id_mahasiswa_pengirim');
            $table->foreign('id_mahasiswa_pengirim')->references('id')->on('mahasiswa');
            $table->unsignedBigInteger('id_mahasiswa_penerima');
            $table->foreign('id_mahasiswa_penerima')->references('id')->on('mahasiswa');
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
        Schema::dropIfExists('pesan_table');
    }
}
