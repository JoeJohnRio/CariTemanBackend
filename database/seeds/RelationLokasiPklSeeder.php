<?php

use Illuminate\Database\Seeder;

class RelationLokasiPklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 50; $i++){
        DB::table('relation_lokasi_pkl')->insert([
            'id_tempat_pkl' => $i,
            'id_lokasi_pkl' => mt_rand(1,25),
          ]);
        }
    }
}
