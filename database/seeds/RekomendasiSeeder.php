<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RekomendasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {$faker = Faker::create('id_ID');

        for($i = 1; $i <= 100; $i++){
    		DB::table('rekomendasi')->insert([
    			'jumlah_rating' => $faker->numberBetween(1,5),
    			'deskripsi' => "Udah bagus nih mas",
    			'is_hidden' => false,
    			'id_pengirim' => 2,
    			'id_penerima' => $faker->numberBetween(2,50)
            ]);
            
            DB::table('rekomendasi')->insert([
    			'jumlah_rating' => $faker->numberBetween(1,5),
    			'deskripsi' => "Udah bagus nih mas",
    			'is_hidden' => false,
    			'id_pengirim' => $faker->numberBetween(2,50),
    			'id_penerima' => 1
    		]);
        }
    }
}
