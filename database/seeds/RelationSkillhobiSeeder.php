<?php

use Illuminate\Database\Seeder;

class RelationSkillhobiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 25; $i++){
        DB::table('relation_skillhobi')->insert([
            'id_mahasiswa' => $i,
            'id_skillhobi' => mt_rand(1,25),
          ]);
        }
    }
}
