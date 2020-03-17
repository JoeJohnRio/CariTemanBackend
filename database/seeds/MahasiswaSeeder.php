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
		
		$url_1 = "https://i.pinimg.com/736x/3e/2e/8c/3e2e8c6fa626636eb4e8bdfe78edab3b--redhead-girl-beautiful-redhead.jpg";
        $url_2 = "https://main-designyoutrust.netdna-ssl.com/wp-content/uploads/2018/06/0-24.jpg?iv=115";
        $url_3 = "https://media.gettyimages.com/photos/portrait-of-senior-businessman-smiling-picture-id985138660?s=612x612";
        $url_4 = "https://static.bhphotovideo.com/explora/sites/default/files/styles/960/public/dof1.jpg?itok=5wIDlC1d";
        $url_5 = "https://s27870.pcdn.co/assets/5182810727_1b26b35355_b-1.jpg";
        $url_6 = "https://greatinspire.com/wp-content/uploads/2012/10/portrait-photography-about-female-by-mariyavetrova.jpg";
        $foto_profil = array( $url_1, $url_2, $url_3, $url_4, $url_5, $url_6 );
		
		$url_foto_1 = "https://3.bp.blogspot.com/-aloAA-710SA/Vt7Xx-pTO7I/AAAAAAAAA34/gnruOkXcAbI/s1600/KTM%2528SHELLA%2BMAHAY%2BSAHRIANI%2529.jpg";
        $url_foto_2 = "https://alhamidiyah.ac.id/assets/cores/dev/files/images/large/STAMIDIYA_190125044205_1.jpg";
        $url_foto_3 = "https://stkipsetiabudhi.ac.id/wp-content/uploads/2019/08/NENG-ITA-LESTARI-KTM.png";
        $url_foto_4 = "https://lh3.googleusercontent.com/proxy/99RHsePCp_8oz_3-9S450NXGzzomrl83PhrSjfc4kjSI9RplUr3jUNNFGNV4ub9uzzCbVX8LgtF_W0S7oSNNU8Fr91pMd8hO9b5vFtWgV1sd5AKEZDK4A8lM7UJWzzM2GTVJarF-s0CGUC4";
        $url_foto_5 = "https://undiksha.ac.id/wp-content/uploads/2018/11/contoh-foto-KTM-Undiksha.jpg";
        $url_foto_6 = "https://1.bp.blogspot.com/-kDnd4KZfF2E/WR9d65Dfj2I/AAAAAAAAAdc/RryH5XtFzl8qS7Gf29dDtnWwmeqZY5sTwCLcB/s1600/img011.jpg";
        $foto_ktm = array( $url_foto_1, $url_foto_2, $url_foto_3, $url_foto_4, $url_foto_5, $url_foto_6 );
		

		DB::table('mahasiswa')->insert([
			[
				'name' => 'joel',
    			'email' => 'joel@joel.joel',
    			'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
				'foto_ktm' => 'https://wallpapercave.com/wp/DTvUQor.jpg',
				'foto_profil' => 'https://media-exp1.licdn.com/dms/image/C5103AQHszi6WjYJl5A/profile-displayphoto-shrink_200_200/0?e=1586995200&v=beta&t=MOSjbQRA54Gk7_a4R36wGHI4AP5LCTsqSKmgJvUAE0k',
				'preferensi' => 0,
				'id_fakultas' => 1,
				'id_program_studi' => 1,
				'id_keminatan' => 1,
				'jenis_kelamin' => 0,
    			'tahun_mulai' => 2017,
    			'nim' => 165150201111157,
			]]);

    	for($i = 1; $i <= 50; $i++){
    		DB::table('mahasiswa')->insert([
    			'name' => $faker->name,
    			'email' => $faker->unique()->safeEmail,
    			'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
				'foto_ktm' => $foto_ktm[mt_rand(0,5)],
				'foto_profil' => $foto_profil[mt_rand(0,5)],
				'jenis_kelamin' => $faker->numberBetween(0,1),
				'id_fakultas' => $faker->numberBetween(1,5),
				'id_program_studi' => $faker->numberBetween(1,11),
				'id_keminatan' => $faker->numberBetween(1,12),
				'preferensi' => $faker->numberBetween(0,1),
    			'tahun_mulai' => $faker->numberBetween(2016,2020),
    			'nim' => $faker->numberBetween(165150201111000, 165150201111200),
    		]);
    	}


    }
}
