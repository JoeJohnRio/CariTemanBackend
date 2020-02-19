<?php

use Illuminate\Database\Seeder;

class HistoryLihatTempatPklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mydate = '23-01-2016';

    for($i = 1; $i <= 50; $i++){
        DB::table('history_lihat_tempat_pkl')->insert([
            'id_mahasiswa' => 1,
            'id_tempat_pkl' => $i,
            'created_at' =>  date('Y-m-d', strtotime($mydate.' + '.$i.' days'))
        ]);
    }
    }
}
