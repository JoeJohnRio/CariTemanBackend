<?php

use Illuminate\Database\Seeder;

class PesanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $mydate = '23-01-2016';
        $y = 1;
        for($i = 1; $i <= 5; $i++){
            for($x = 1; $x <= 15; $x++){
    		DB::table('pesan')->insert([
    			'isi_pesan' => "isi pesan .$x",
                'id_mahasiswa_pengirim' => $x,
                'id_mahasiswa_penerima' =>  $i,
                'created_at' =>  date('Y-m-d', strtotime($mydate.' + '.($y++).' days')),
    			'updated_at' => date('Y-m-d', strtotime($mydate.' + '.$y.' days'))
    		]);
            }
        }
    }
}
