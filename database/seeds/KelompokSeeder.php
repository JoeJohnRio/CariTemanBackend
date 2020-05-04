<?php

use App\Kelompok;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        
        $firstSentence = array("Gambang",
         "Bisa",
          "Asik",
           "Mudah Mudahan");

           $secondSentence = array("Senang", 
           "Sedih", 
           "Lucu",
           "Bingung", 
           "Lupa",
           "Malas",
            "Banget");

        for($i = 1; $i <= 15; $i++){
    		DB::table('kelompok')->insert([
                'nama_kelompok' => "Kelompok ".$firstSentence[$faker->numberBetween(0,3)]. " " .$secondSentence[$faker->numberBetween(0, 5)] ,
                'jumlah_anggota' => $i+2,
                'tipe_kelompok' => $faker->numberBetween(0, 1),
                'foto_kelompok' => "https://cdn.shopify.com/s/files/1/0061/8119/1793/products/2046-60-mistyteal_3472a883-658e-4f06-b350-387a8eafa4ae_2000x.png?v=1571743298"
    		]);
    	}

        for($i = 1; $i <= 15; $i++){
            for($a = 1; $a <=5; $a++){
                DB::table('relation_kelompok')->insert([
                    'id_kelompok' => $i,
                    'id_mahasiswa' => $faker->numberBetween(1, 25),
                    'status' => 1
                ]);    
            }
        }        
    }
}
