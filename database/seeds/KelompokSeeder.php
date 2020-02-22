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
        
        for($i = 1; $i <= 5; $i++){
    		DB::table('kelompok')->insert([
                'nama_kelompok' => "kelompok $i",
                'jumlah_anggota' => $i+2,
                'tipe_kelompok' => $faker->numberBetween(0, 1),
                'foto_kelompok' => "https://saatteduh.com/data/articles/store/201903/2-3qW9wCZT-Qxjf7KmW-cxCH8vyc.jpg"
    		]);
    	}

        $counterReal = 3;
        for($i = 1; $i <= 5; $i++){
            for($a = 1; $a <=$counterReal; $a++){
                DB::table('relation_kelompok')->insert([
                    'id_kelompok' => $i,
                    'id_mahasiswa' => $faker->numberBetween(1, 25),
                    'status' => 1
                ]);    
            }
            $counterReal++;
        }        
    }
}
