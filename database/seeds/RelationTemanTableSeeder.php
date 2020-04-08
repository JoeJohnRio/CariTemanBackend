<?php

use Illuminate\Database\Seeder;

class RelationTemanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 2; $i <= 50; $i++){
    		DB::table('relation_teman')->insert([
                'is_favorite' => mt_rand(0,1),
                'id_mahasiswa_one' => '1',
                'id_mahasiswa_two' => $i,
                'status' => '1',
    		]);
    	}
        // if(DB::table('relation_teman')->get()->count() == 0){

        //     DB::table('relation_teman')->insert([
        //         [
        //             'is_favorite' => '0',
        //             'id_mahasiswa_one' => '1',
        //             'id_mahasiswa_two' => '2',
        //             'status' => '1',
        //         ],
        //         [
        //             'is_favorite' => '0',
        //             'id_mahasiswa_one' => '1',
        //             'id_mahasiswa_two' => '3',
        //             'status' => '0'
        //         ],
        //         [
        //             'is_favorite' => '1',
        //             'id_mahasiswa_one' => '1',
        //             'id_mahasiswa_two' => '4',
        //             'status' => '1'
        //         ]            
        //         ]);
        // }
    }
}
