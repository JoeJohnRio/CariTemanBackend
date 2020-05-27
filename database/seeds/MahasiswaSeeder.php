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
		
		$url_1 = "https://media.gettyimages.com/photos/portrait-of-smiling-man-with-stubble-wearing-grey-sweatshirt-picture-id946919736?s=612x612";
        $url_2 = "https://res.cloudinary.com/dk0z4ums3/image/upload/v1583802836/attached_image/sars.jpg";
        $url_3 = "https://awsimages.detik.net.id/community/media/visual/2019/09/03/26da437d-b66d-4480-b224-2566cb8ab3be_169.jpeg?w=620";
        $url_4 = "https://img.okeinfo.net/content/2019/11/18/320/2131233/bill-gates-kembali-jadi-orang-terkaya-berkat-saham-microsoft-HRBNU8qd8d.jpg";
        $url_5 = "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSD4tQJq72G0VXnSnJYZXpM9G4bCdbidx_aEtsPrecpJrW2j9vt&usqp=CAU";
        $url_6 = "https://i.guim.co.uk/img/media/bccce509e3af0813718958350d95ce33bb2d7379/0_495_4871_4888/master/4871.jpg?width=445&quality=85&auto=format&fit=max&s=e47ecdbe10e239bc8c597f172eb06fe4";
		$url_7 = "https://akcdn.detik.net.id/community/media/visual/2019/05/21/209b6455-ba3f-4072-b7b4-7b65f8099d63_169.jpeg?w=600&q=90";
		$url_8 = "https://awsimages.detik.net.id/community/media/visual/2019/05/23/e77d04d3-64be-4678-974a-0e5bb3f851c7_169.jpeg?w=600&q=60";
		$url_9 = "https://awsimages.detik.net.id/visual/2018/02/26/519841ea-640c-4e57-ad5c-4c1cb06151cd_169.jpeg?w=650";
		$url_10 = "https://akcdn.detik.net.id/community/media/visual/2019/04/06/fb8a3b99-ebb2-4e6d-9109-6aa3b84dd165_169.jpeg?w=700&q=90";
		$url_11 = "https://asset.kompas.com/crops/L549LokkgzgFCsE--ChsWxoYDyQ=/0x12:676x463/750x500/data/photo/2017/06/17/257176401.jpg";
		$foto_profil = array( $url_1, $url_2, $url_3, $url_4, $url_5, $url_6, $url_7, $url_8, $url_9, $url_10, $url_11);
		
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
				'is_verified' => true,
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

			DB::table('admin')->insert([
				[
					'email' => 'admin@cariteman.com',
					'password' => '$2y$10$kvXDF5RhCiZvo/SHLqLVrOCA.U1lA8n/d8hnXzhmKhl1JCy4cL2T2' //adminadmin
				]]);

    	for($i = 1; $i <= 50; $i++){
    		DB::table('mahasiswa')->insert([
    			'name' => $faker->name,
				'email' => $faker->unique()->safeEmail,
				'is_verified' => true,
    			'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
				'foto_ktm' => $foto_ktm[mt_rand(0,5)],
				'foto_profil' => $foto_profil[mt_rand(0,10)],
				'jenis_kelamin' => $faker->numberBetween(0,1),
				'id_fakultas' => $faker->numberBetween(1,5),
				'id_program_studi' => $faker->numberBetween(1,11),
				'id_keminatan' => $faker->numberBetween(1,12),
				'preferensi' => $faker->numberBetween(0,1),
    			'tahun_mulai' => $faker->numberBetween(2016,2020),
    			'nim' => $faker->numberBetween(165150201111000, 165150201111200),
    		]);
		}
		
		for($i = 1; $i <= 25; $i++){
    		DB::table('mahasiswa')->insert([
    			'name' => $faker->name,
    			'email' => $faker->unique()->safeEmail,
				'is_verified' => false,
    			'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
				'foto_ktm' => $foto_ktm[mt_rand(0,5)],
				'foto_profil' => $foto_profil[mt_rand(0,10)],
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
