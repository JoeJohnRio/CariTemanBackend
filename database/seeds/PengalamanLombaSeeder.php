<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PengalamanLombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        
        $mydate = '23-01-2016';

        for($i = 1; $i <= 100; $i++){
    		DB::table('pengalaman_lomba')->insert([
    			'nama_kompetisi' => "kompetisi $i",
                'deskripsi' => "deskripsi $i",
                'tanggal' =>  date('Y-m-d', strtotime($mydate.' + '.$i.' days')),
    			'id_mahasiswa' => $faker->numberBetween(1,50),
                'gambar' => "https://alhamidiyah.ac.id/assets/cores/dev/files/images/large/STAMIDIYA_190125044205_1.jpg",
    		]);
    	}
    }
}
