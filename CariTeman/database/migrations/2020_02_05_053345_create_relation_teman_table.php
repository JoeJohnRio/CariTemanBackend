<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationTemanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_teman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_favorite');
            $table->boolean('status');
            $table->unsignedBigInteger('id_mahasiswa_one');
            $table->foreign('id_mahasiswa_one')->references('id')->on('mahasiswa');
            $table->unsignedBigInteger('id_mahasiswa_two');
            $table->foreign('id_mahasiswa_two')->references('id')->on('mahasiswa');
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
        Schema::dropIfExists('teman_table');
    }
}
