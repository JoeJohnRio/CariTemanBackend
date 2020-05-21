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
        $kota = array("Banda Aceh", 
        "Langsa", 
        "Bengkulu", 
        "Sungai Penuh", 
        "Cimahi", 
        "Tasikmalaya", 
        "Semarang", 
        "Kota Administrasi Jakarta Utara", 
        "Kota Administrasi Jakarta Timur", 
        "Bogor", 
        "Tasikmalaya", 
        "Pekalongan", 
        "Purwokerto", 
        "Kediri", 
        "Singkawang", 
        "Tarakan", 
        "Batam", 
        "Tanjungpinang", 
        "Parepare" 
    );

        for($i = 1; $i <= 50; $i++){
    		DB::table('lokasi_pkl')->insert([
    			'nama_kota' => $kota[mt_rand(0,18)],
    		]);
    	}
    }
}
