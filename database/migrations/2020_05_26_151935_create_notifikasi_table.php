<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('notifikasi_type');
            $table->integer('is_read')->default(0);
            $table->unsignedBigInteger('id_mahasiswa_pengirim')->nullable();
            $table->foreign('id_mahasiswa_pengirim')->references('id')->on('mahasiswa');
            $table->unsignedBigInteger('id_mahasiswa_penerima')->nullable();
            $table->foreign('id_mahasiswa_penerima')->references('id')->on('mahasiswa');
            $table->unsignedBigInteger('id_kelompok')->nullable();
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
        Schema::dropIfExists('notifikasi');
    }
}
