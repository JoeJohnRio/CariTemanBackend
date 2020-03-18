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
        for($i = 1; $i <= 3; $i++){
        for($i = 1; $i <= 50; $i++){
    		DB::table('ulasan_tempat_pkl')->insert([
    			'ulasan' => "Ulasan $i",
                'id_tempat_pkl' => $i,
                'id_pengirim' => $i,
    		]);
        }
    }
    }
}
