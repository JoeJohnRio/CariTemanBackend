<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TempatPklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url_1 = "https://i.pinimg.com/736x/3e/2e/8c/3e2e8c6fa626636eb4e8bdfe78edab3b--redhead-girl-beautiful-redhead.jpg";
        $url_2 = "https://main-designyoutrust.netdna-ssl.com/wp-content/uploads/2018/06/0-24.jpg?iv=115";
        $url_3 = "https://media.gettyimages.com/photos/portrait-of-senior-businessman-smiling-picture-id985138660?s=612x612";
        $url_4 = "https://static.bhphotovideo.com/explora/sites/default/files/styles/960/public/dof1.jpg?itok=5wIDlC1d";
        $url_5 = "https://s27870.pcdn.co/assets/5182810727_1b26b35355_b-1.jpg";
        $url_6 = "https://greatinspire.com/wp-content/uploads/2012/10/portrait-photography-about-female-by-mariyavetrova.jpg";
        $gambar_url = array( $url_1, $url_2, $url_3, $url_4, $url_5, $url_6 );
        for($i = 1; $i <= 50; $i++){
    		DB::table('tempat_pkl')->insert([
    			'nama_perusahaan' => "Tempat Pkl $i",
                'id_lokasi_pkl' => mt_rand(1,50),
                'gambar' => $gambar_url[mt_rand(0,5)],
    			'id_bidang_kerja' => mt_rand(1,50), //secret
    		]);
    	}
    }
}
