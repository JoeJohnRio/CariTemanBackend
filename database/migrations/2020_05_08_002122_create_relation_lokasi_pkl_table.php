<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationLokasiPklTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_lokasi_pkl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tempat_pkl');
            $table->foreign('id_tempat_pkl')->references('id')->on('tempat_pkl');
            $table->unsignedBigInteger('id_lokasi_pkl');
            $table->foreign('id_lokasi_pkl')->references('id')->on('lokasi_pkl');
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
        Schema::dropIfExists('relation_lokasi_pkl');
    }
}
