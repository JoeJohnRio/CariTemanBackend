<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RelationBidangKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('id_ID');

        for($i = 1; $i <= 25; $i++){
    		DB::table('relation_bidang_kerja')->insert([
    			'id_mahasiswa' => $faker->numberBetween(1,2),
    			'id_bidang_kerja' => $faker->numberBetween(1, 2),
    		]);
        }
        for($i = 1; $i <= 25; $i++){
    		DB::table('relation_bidang_kerja')->insert([
    			'id_tempat_pkl' => $faker->numberBetween(1,2),
    			'id_bidang_kerja' => $faker->numberBetween(1, 2),
    		]);
    	}
    }
}
