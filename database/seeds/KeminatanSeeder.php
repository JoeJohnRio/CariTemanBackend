<?php

use Illuminate\Database\Seeder;

class KeminatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('keminatan')->get()->count() == 0){

        DB::table('keminatan')->insert([
            [
                'name' => 'Tidak Memiliki Keminatan',
                'id_program_studi' => '2'
            ],
            [
                'name' => 'Tidak Memiliki Keminatan',
                'id_program_studi' => '3'
            ],
            [
                'name' => 'Tidak Memiliki Keminatan',
                'id_program_studi' => '4'
            ],
            [
                'name' => 'Tidak Memiliki Keminatan',
                'id_program_studi' => '5'
            ],
            [
                'name' => 'Tidak Memiliki Keminatan',
                'id_program_studi' => '6'
            ],
            [
                'name' => 'Tidak Memiliki Keminatan',
                'id_program_studi' => '7'
            ],
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'id_program_studi' => '1'
            ],
            [
                'name' => 'Komputasi Berbasis Jaringan',
                'id_program_studi' => '1'
            ],
            [
                'name' => 'Komputasi Cerdas',
                'id_program_studi' => '1'
            ],
            [
                'name' => 'Multimedia, Game, & Mobile',
                'id_program_studi' => '1'
            ],
            [
                'name' => 'Hukum Perdata',
                'id_program_studi' => '8'
            ],
            [
                'name' => 'Hukum Pidana',
                'id_program_studi' => '8'
            ],
            [
                'name' => 'Hukum Tata Negara',
                'id_program_studi' => '8'
            ],
            [
                'name' => 'Hukum Internasional',
                'id_program_studi' => '8'
            ],
            [
                'name' => 'Hukum Ekonomi Bisnis',
                'id_program_studi' => '8'
            ],
            [
                'name' => 'Tidak Memiliki Keminatan',
                'id_program_studi' => '9'
            ],
            [
                'name' => 'Tidak Memiliki Keminatan',
                'id_program_studi' => '10'
            ],
            [
                'name' => 'Manajemen',
                'id_program_studi' => '11'
            ],
            [
                'name' => 'Teknologi',
                'id_program_studi' => '11'
            ],
            [
                'name' => 'Rekayasa',
                'id_program_studi' => '11'
            ]]
        );
        }
    }
}
