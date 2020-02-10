<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_verified')->default(false);
            $table->string('password');
            $table->string('name');
            $table->string('email');
            $table->string('foto_ktm');
            $table->string('foto_profil')->default('no photo');
            $table->string('nim');
            $table->integer('tahun_mulai');
            $table->integer('preferensi')->default(0);
            $table->unsignedBigInteger('id_fakultas')->nullable();
            $table->foreign('id_fakultas')->references('id')->on('fakultas');

            $table->unsignedBigInteger('id_program_studi')->nullable();
            $table->foreign('id_program_studi')->references('id')->on('program_studi');
            
            $table->unsignedBigInteger('id_keminatan')->nullable();
            $table->foreign('id_keminatan')->references('id')->on('keminatan');
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
        Schema::dropIfExists('mahasiswa');
    }
}
