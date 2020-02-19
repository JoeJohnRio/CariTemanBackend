<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TempatPklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 50; $i++){
    		DB::table('tempat_pkl')->insert([
    			'nama_perusahaan' => "Tempat Pkl $i",
    			'id_lokasi_pkl' => mt_rand(1,50),
    			'id_bidang_kerja' => mt_rand(1,50), //secret
    		]);
    	}
    }
}
