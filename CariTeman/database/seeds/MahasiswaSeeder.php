<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
    	$faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('mahasiswa')->insert([
    			'name' => $faker->name,
    			'email' => $faker->unique()->safeEmail,
    			'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
    			'foto_ktm' => 'https://alhamidiyah.ac.id/assets/cores/dev/files/images/large/STAMIDIYA_190125044205_1.jpg',
    			'preferensi' => $faker->numberBetween(0,1),
    			'tahun_mulai' => $faker->numberBetween(2016,2020),
    			'nim' => $faker->numberBetween(165150201111000, 165150201111200),
    		]);
 
    	}


    }
}
