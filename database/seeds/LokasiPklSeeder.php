<?php

use Illuminate\Database\Seeder;

class LokasiPklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 50; $i++){
    		DB::table('lokasi_pkl')->insert([
    			'nama_kota' => "kota $i",
    		]);
    	}
    }
}
