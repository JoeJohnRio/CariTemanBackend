<?php

use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('program_studi')->get()->count() == 0){

            DB::table('program_studi')->insert([
                [
            'name' => 'Teknik Informatika',
            'id_fakultas' => '1'
        ],
        [
            'name' => 'Sistem Informasi',
            'id_fakultas' => '1'
        ],
        [
            'name' => 'Teknik Komputer',
            'id_fakultas' => '1'
        ],
        [
            'name' => 'Teknik Mesin',
            'id_fakultas' => '2'
        ],
        [
            'name' => 'Teknik Sipil',
            'id_fakultas' => '2'
        ],
        [
            'name' => 'Pendidikan Kedokteran',
            'id_fakultas' => '3'
        ],
        [
            'name' => 'Keperawatan',
            'id_fakultas' => '3'
        ],
        [
            'name' => 'Hukum',
            'id_fakultas' => '4'
        ],
        [
            'name' => 'Ilmu dan Teknologi Pangan',
            'id_fakultas' => '5'
        ],
        [
            'name' => 'Keteknikan Pertanian',
            'id_fakultas' => '5'
        ],
        [
            'name' => 'Teknologi Industri Pertanian',
            'id_fakultas' => '5'
        ]]
    );}
}
}
