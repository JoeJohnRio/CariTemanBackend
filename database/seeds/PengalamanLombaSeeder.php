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

        $fotoKompetisi = array("https://dreamhack.se/dhs12/files/2012/06/fnaticsm_w700_h247.jpg",
        "https://s.france24.com/media/display/cfe953be-c759-11e9-8eb5-005056bff430/14e93502ffce93016f0126c34bd81b7c551a95f3.jpg",
        "https://www.smileexpo.ru/public/upload/news/dreamhack_masters_malmo_g2_esports_became_winner_15047066558831_image.jpg",
        "https://esports-marketing-blog.com/wp-content/uploads/eSports-IQ-Week-10-What-does-eSports-on-TV-really-need.jpg",
        "https://image.cnbcfm.com/api/v1/image/106044681-1564357271124gettyimages-1164792901.jpeg?v=1564357337&w=1600&h=900",
        "https://ggwp.id/media/wp-content/uploads/2017/12/Headhunter-League-of-Legends-1.jpg",
        "https://api.duniagames.co.id/api/content/upload/file/13033865081575868656.jpeg",
        "https://mygaming.co.za/news/wp-content/uploads/2016/09/eSports-winner.jpg",
        "https://gamerbraves.sgp1.cdn.digitaloceanspaces.com/2019/09/PES-2019-575-SOULCALIBUR-Asia-League-.jpg",
        "https://informatika.unida.gontor.ac.id/wp-content/uploads/2019/04/image-8.png",
        "https://onsideview.com/wp-content/uploads/2018/10/newcastle.jpg",
        "https://api.duniagames.co.id/api/content/upload/file/19562420941575876533.jpg",
        "https://www.revivaltv.id/wp-content/uploads/2018/09/39044730_274607183332062_2481316041280454656_o.jpg",
        "https://www.thetotallyfootballshow.com/app/uploads/2020/04/so-you-havent-got-any-football-to-watch-every-championship-playoff-final-ever-1987-2019-900x480.jpg",
        "https://www.ncaa.com/sites/default/files/public/styles/medium_4x3/public-s3/tile-images/franchise_hero/JS3_6632_0.jpg?h=2c620b04&itok=qL_Vg_nz",
        "https://cdn-radar.jawapos.com/uploads/radarsurabaya/news/2020/03/26/persebaya-batal-tampil-di-turnamen-asean-club-championship_m_185599.jpg",
        "https://i2-prod.chroniclelive.co.uk/incoming/article17937396.ece/ALTERNATES/s615/0_West-Bromwich-Albion-v-Leeds-United-Sky-Bet-Championship-The-Hawthorns.jpg",
        "https://jurnalapps.co.id/assets/img/content/1558938899_pmco-2.JPG",
        "https://www.kapuaspost.co.id/wp-content/uploads/2019/09/AXIS-ML_2.jpg",
        "https://unpak.ac.id/pic/2020/gamer-telkomsel.webp");

        $contohKompetisi = array("Mental abacus", 
        "Academic Games", 
        "Ames Moot Court Competition", 
        "Andrei Stenin International Press Photo Contest", 
        "Best Illusion of the Year Contest", 
        "Bug bounty program", 
        "Capture the Flag", 
        "Delphic Games of the modern era", 
        "Egg drop competition", 
        "International Delphic Committee", 
        "Macalester Plymouth United Church Hymn Contest", 
        "SWAT World Challenge", 
        "World Memory Championships", 
        "Student competition", 
        "Stock Market Learning");

        for($i = 1; $i <= 25; $i++){
    		DB::table('pengalaman_lomba')->insert([
    			'nama_kompetisi' => $contohKompetisi[$faker->numberBetween(0,14)],
                'deskripsi' => "Pernah memenangkan " .$contohKompetisi[$faker->numberBetween(0,14)]. "",
                'tanggal' =>  date('Y-m-d', strtotime($mydate.' + '.$i.' days')),
    			'id_mahasiswa' => $faker->numberBetween(1,50),
                'gambar' => $fotoKompetisi[$faker->numberBetween(0,19)],
    		]);
    	}
    }
}
