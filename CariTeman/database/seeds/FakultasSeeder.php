<?php

use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(DB::table('fakultas')->get()->count() == 0){

            DB::table('fakultas')->insert([
                [
        	'name' => 'Ilmu Komputer'
        ], [
        	'name' => 'Teknik'
        ], [
        	'name' => 'Kedokteran'
        ], [
        	'name' => 'Hukum'
        ], [
        	'name' => 'Teknologi Pertanian'
        ]]);
    }
}
}