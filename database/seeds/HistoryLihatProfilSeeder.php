<?php

use Illuminate\Database\Seeder;

class HistoryLihatProfilSeeder extends Seeder
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
        DB::table('history_lihat_profil')->insert([
            'id_mahasiswa_one' => 1,
            'id_mahasiswa_two' => $i,
            'created_at' =>  date('Y-m-d', strtotime($mydate.' + '.$i.' days'))
        ]);
    }
    }
}
