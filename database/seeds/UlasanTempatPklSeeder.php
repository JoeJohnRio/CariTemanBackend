<?php

use Illuminate\Database\Seeder;

class UlasanTempatPklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($a = 1; $a <= 3; $a++){
        for($i = 1; $i <= 25; $i++){
    		DB::table('ulasan_tempat_pkl')->insert([
    			'ulasan' => "Ulasan $i",
                'id_tempat_pkl' => $i,
                'id_pengirim' => $i,
    		]);
        }
    }
    }
}
