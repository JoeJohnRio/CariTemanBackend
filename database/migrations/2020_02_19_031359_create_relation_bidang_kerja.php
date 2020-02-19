<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationBidangKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('relation_bidang_kerja', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa');
            $table->unsignedBigInteger('id_bidang_kerja');
            $table->foreign('id_bidang_kerja')->references('id')->on('bidang_kerja');
            $table->unsignedBigInteger('id_tempat_pkl')->nullable();
            $table->foreign('id_tempat_pkl')->references('id')->on('tempat_pkl');
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
        Schema::table('relation_bidang_kerja', function (Blueprint $table) {
        });
    }
}
