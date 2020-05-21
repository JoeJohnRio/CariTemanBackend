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
        $perusahaan = array("PT. Kuala Pelabuhan Indonesia", 
        "PT. Kurnia Jaya Raya", 
        "PT. Kyung Dong Indonesia", 
        "PT. Kyungseung Trading Indonesia", 
        "PT. Ladangrumput Suburabadi", 
        "PT. Les Nouveaux Premier Real Property Indonesia", 
        "PT. Maskapai Perkebunan Leidong West Indonesia", 
        "PT. Marga Nusantara Jaya", 
        "PT. Marta Unikatama", 
        "PT. McDermott Indonesia", 
        "PT. Meares Soputan Mining", 
        "PT. Mega Kemiraya", 
        "PT. Melputra Garmindo", 
        "PT. Mesitechmitra Purnabangun", 
        "PT. Metec Semarang", 
        "PT. Mintek Dendrill Indonesia", 
        "PT. Mitra Infoparama", 
        "PT. Mitraland Harapan Sejati", 
        "PT. Molten Aluminium Producer Indonesia" 
    );

        $url_1 = "https://strategimanajemen.net/apps23/wp-content/uploads/2018/04/re-apt.jpg";
        $url_2 = "https://www.jagoteknologi.com/wp-content/uploads/2018/05/Alphabet-Google.jpg";
        $url_3 = "https://cdn.idntimes.com/content-images/community/2019/06/1-504c3148a79864e3781dc70ec656da3f_600x400.jpg";
        $url_4 = "https://www.whiteboardjournal.com/wp-content/uploads/2018/10/bytedance.jpg";
        $url_5 = "https://s3-ap-southeast-1.amazonaws.com/assets-blog.sewakantorcbd.com/blog/wp-content/uploads/2018/12/26092710/wisma77-b-683x1024.jpg";
        $url_6 = "https://kao-h.assetsadobe3.com/is/image/content/dam/sites/kao/www-kao-com/id/id/about/outline/profile/image-01.jpg?wid=1500";
        $gambar_url = array( $url_1, $url_2, $url_3, $url_4, $url_5, $url_6 );
        for($i = 1; $i <= 50; $i++){
    		DB::table('tempat_pkl')->insert([
    			'nama_perusahaan' => $perusahaan[mt_rand(0,18)],
                'id_lokasi_pkl' => mt_rand(1,50),
                'phone_number'=> 55500000+mt_rand(00000, 99999),
                'gambar' => $gambar_url[mt_rand(0,5)],
    			'id_relation_bidang_kerja' => mt_rand(1,25), //secret
    		]);
    	}
    }
}
