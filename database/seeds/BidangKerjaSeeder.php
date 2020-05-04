<?php

use Illuminate\Database\Seeder;

class BidangKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $namaPekerjaan = array("Software developer", 
        "Agricultural and Food Science Technicians", 
        "Aircraft Rigging Assemblers", 
        "Architectural and Civil Drafters", 
        "Barbers", 
        "Battery Repairers", 
        "Tester", 
        "System Engineer", 
        "Game Developer", 
        "Android Developer", 
        "Scrum Master", 
        "Lead of Tech", 
        "Lead of Creative", 
        "Architechture Assistant", 
        "Room Enhancer", 
        "Backend Developer", 
        "Front End Developer", 
        "Food Expert", 
        "Promo Consultant" 
    );
        for($i = 1; $i <= 50; $i++){
    		DB::table('bidang_kerja')->insert([
    			'nama_bidang_kerja' => $namaPekerjaan[mt_rand(0,18)],
    		]);
    	}
    }
}
