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

        DB::table('pengalaman_organisasi')->insert([
            'nama_organisasi' => "organisasi master",
            'deskripsi' => "deskripsi master",
            'tanggal_mulai' =>  date('Y-m-d', strtotime($mydate)),
            'tanggal_selesai' =>  date('Y-m-d', strtotime($mydate)),
    		'id_mahasiswa' => 1,
            'gambar' => "https://alhamidiyah.ac.id/assets/cores/dev/files/images/large/STAMIDIYA_190125044205_1.jpg"
        ]);

        DB::table('pengalaman_organisasi')->insert([
            'nama_organisasi' => "organisasi master2",
            'deskripsi' => "deskripsi master2",
            'tanggal_mulai' =>  date('Y-m-d', strtotime($mydate)),
            'tanggal_selesai' =>  date('Y-m-d', strtotime($mydate)),
    		'id_mahasiswa' => 1,
            'gambar' => "https://alhamidiyah.ac.id/assets/cores/dev/files/images/large/STAMIDIYA_190125044205_1.jpg"
        ]);

        DB::table('pengalaman_organisasi')->insert([
            'nama_organisasi' => "organisasi master3",
            'deskripsi' => "deskripsi master3",
            'tanggal_mulai' =>  date('Y-m-d', strtotime($mydate)),
            'tanggal_selesai' =>  date('Y-m-d', strtotime($mydate)),
    		'id_mahasiswa' => 1,
            'gambar' => "https://alhamidiyah.ac.id/assets/cores/dev/files/images/large/STAMIDIYA_190125044205_1.jpg"
        ]);

        for($i = 1; $i <= 100; $i++){
    		DB::table('pengalaman_organisasi')->insert([
    			'nama_organisasi' => "organisasi $i",
                'deskripsi' => "deskripsi $i",
                'tanggal_mulai' =>  date('Y-m-d', strtotime($mydate.' + '.$i.' days')),
                'tanggal_selesai' =>  date('Y-m-d', strtotime($mydate.' + '.($i+30).' days')),
    			'id_mahasiswa' => $faker->numberBetween(1,50),
    			'gambar' => "https://alhamidiyah.ac.id/assets/cores/dev/files/images/large/STAMIDIYA_190125044205_1.jpg"
    		]);
    	}
    }
}
