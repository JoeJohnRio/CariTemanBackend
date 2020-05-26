<?php

use Illuminate\Database\Seeder;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $mydate = '23-01-2016';
        for($i = 1; $i <= 10; $i++){
    		DB::table('notifikasi')->insert([
    			'notifikasi_type' => mt_rand(1,3),
                'is_read' => 0,
                'id_mahasiswa_pengirim' => mt_rand(45,50),
                'id_mahasiswa_penerima' => 1,
                'created_at' =>  date('Y-m-d', strtotime($mydate.' + '.($i+30).' days')),
    		]);
        }
    }
}
