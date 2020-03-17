<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempatPkl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempat_pkl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_perusahaan');
            $table->string('gambar');
            $table->unsignedBigInteger('id_lokasi_pkl');
            $table->foreign('id_lokasi_pkl')->references('id')->on('lokasi_pkl');
            $table->unsignedBigInteger('id_bidang_kerja');
            $table->foreign('id_bidang_kerja')->references('id')->on('bidang_kerja');
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
        Schema::dropIfExists('tempat_pkl');
    }
}
