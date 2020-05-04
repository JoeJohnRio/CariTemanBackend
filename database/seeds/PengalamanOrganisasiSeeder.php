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
        $fotoOrganisasi = array("https://storage.nu.or.id/storage/post/16_9/big/1576929205.jpg",
        "https://storage.nu.or.id/storage/post/16_9/big/15563337055cc3c48999037.jpg",
        "https://cdn.idntimes.com/content-images/community/2018/05/mahasiswa2-33c3945e261405599475cee91a8debd8_600x400.jpg",
        "https://storage.nu.or.id/storage/post/16_9/big/1583243214.jpg",
        "https://www.mpssoft.co.id/blog/wp-content/uploads/2019/07/struktur-organisasi-fungsional-1.jpg",
        "https://www.its.ac.id/wp-content/uploads/2018/04/IMG_0558-1024x663.jpg",
        "https://www.karyaone.co.id/wp-content/uploads/2019/10/Struktur-Organisasi-Fungsional.jpg",
        "https://i1.wp.com/60dtk.com/wp-content/uploads/2020/03/30-Maret-2020-KNPI-Organisasi-Pertama-Mendaftar-sebagai-Relawan-Covid-19.jpg?resize=741%2C425&ssl=1",
        "https://cdn.medcom.id/dynamic/content/2018/10/29/947012/lNvDUazgM3.jpg?w=480");
        
        $contohOrganisasi = array("Badan Eksekutif Mahasiswa",
        "Dewan Perwakilan Mahasiswa",
        "KSM Eka Prasetya",
        "English Debating Society",
        "Suara Mahasiswa",
        "Center for Entrepreneurship Development and Studies",
        "Association Internationale et Studiant Sociale Economi",
        "Model United Nation",
        "UB Achievement Community",
        "Tim Robot UB",
        "Liga Tari Krida Budaya",
        "Marching Band Madah Bahana",
        "Orkes Simfoni Mahawaditra",
        "Paduan Suara Paragita",
        "Teater",
        "Sinematografi",
        "Radio Telekomukasi Cipta",
        "Dancesport",
        "Karawaitan Jawa Sekar Widya Makara",
        "Klub Mode UB");

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

        for($i = 1; $i <= 25; $i++){
    		DB::table('pengalaman_organisasi')->insert([
    			'nama_organisasi' => $contohOrganisasi[$faker->numberBetween(0,19)],
                'deskripsi' => "Berpengalaman di " .$contohOrganisasi[$faker->numberBetween(0,19)]. "",
                'tanggal_mulai' =>  date('Y-m-d', strtotime($mydate.' + '.$i.' days')),
                'tanggal_selesai' =>  date('Y-m-d', strtotime($mydate.' + '.($i+30).' days')),
    			'id_mahasiswa' => $faker->numberBetween(1,50),
    			'gambar' => $fotoOrganisasi[$faker->numberBetween(0,8)]
    		]);
    	}
    }
}
