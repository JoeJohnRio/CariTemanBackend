<?php

use Illuminate\Database\Seeder;

class SkillhobiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $namaSkillHobi = array("Animation", 
        "Craft", 
        "Cue sports", 
        "Distro Hopping", 
        "DJing", 
        "Electronics", 
        "Experimenting", 
        "Fashion", 
        "Furniture building", 
        "Gingerbread house making", 
        "Graphic design", 
        "Hula hooping", 
        "Karaoke", 
        "Knot tying", 
        "Leather crafting", 
        "Philately", 
        "Quizzes", 
        "Robot combat", 
        "Whittling" 
    );
        for($i = 1; $i <= 50; $i++){
    		DB::table('skillhobi')->insert([
    			'nama_skillhobi' => $namaSkillHobi[mt_rand(0,18)],
    		]);
    	}
    }
}
