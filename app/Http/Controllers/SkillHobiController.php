<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\Skillhobi;


class SkillHobiController extends Controller
{

    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showSearchSkillhobi($namaSkillhobi){
        return Skillhobi::where('nama_skillhobi', $namaSkillhobi)
        ->orWhere('nama_skillhobi', 'like', '%' .  $namaSkillhobi . '%')->get();
    }

    public function makeSkillhobi($namaSkillhobi){
        $skillhobiMake = new Skillhobi();
        $skillhobiMake->nama_skillhobi = $namaSkillhobi;
        $skillhobiMake->save();

        return Skillhobi::where('nama_skillhobi', $namaSkillhobi)->first();
    }
}
