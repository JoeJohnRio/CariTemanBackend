<?php

use Illuminate\Database\Seeder;

class RelationTempatPklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 2; $i <= 50; $i++){
        DB::table('relation_tempat_pkl')->insert([
            'is_favorite' => mt_rand(0,1),
            'id_mahasiswa' => '1',
            'id_tempat_pkl' => $i
        ]);
    }
    }
}
