<?php

use Illuminate\Database\Seeder;

class SearchHistorySeeder extends Seeder
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
        DB::table('search_history')->insert([
            'name' => "test $i",
            'search_type' => mt_rand(0,2),
            'id_tempat_pkl' => mt_rand(2,50),
            'id_mahasiswa' => mt_rand(2,50),
            'id_owner_history' => mt_rand(1,2),
            'created_at' =>  date('Y-m-d', strtotime($mydate.' + '.$i.' days'))
        ]);
        }
    }
}
