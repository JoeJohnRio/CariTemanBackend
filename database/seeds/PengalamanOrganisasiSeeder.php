<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PengalamanOrganisasiSeeder extends Seeder
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

        for($i = 1; $i <= 25; $i++){
    		DB::table('pengalaman_organisasi')->insert([
    			'nama_organisasi' => "organisasi $i",
                'deskripsi' => "deskripsi $i",
                'tanggal_mulai' =>  date('Y-m-d', strtotime($mydate.' + '.$i.' days')),
                'tanggal_selesai' =>  date('Y-m-d', strtotime($mydate.' + '.($i+30).' days')),
    			'id_mahasiswa' => $faker->numberBetween(1,4),
    			'id_bidang_kerja' => $faker->numberBetween(1,4)
    		]);
    	}
    }
}
