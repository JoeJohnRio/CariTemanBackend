<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use JWTAuth;
use \stdClass;
use App\Http\Controllers\Controller;
use App\Fakultas;
use App\ProgramStudi;
use App\Keminatan;

class AdminController extends Controller
{
    public function mahasiswaNeedVerification(){
        $mahasiswas =  Mahasiswa::where('is_verified', 0)->get();


		$all = collect();
        foreach($mahasiswas as $mahasiswa){
            $newMahasiswa = new stdClass();
            
            $newMahasiswa->id = $mahasiswa->id;
            $newMahasiswa->name = $mahasiswa->name;
            $newMahasiswa->tahun_mulai = $mahasiswa->tahun_mulai;
            $newMahasiswa->nim = $mahasiswa->nim;
            $newMahasiswa->fakultas = Fakultas::find($mahasiswa->id_fakultas)->name;
            $newMahasiswa->program_studi = ProgramStudi::find($mahasiswa->id_program_studi)->name;
            $newMahasiswa->keminatan = Keminatan::find($mahasiswa->id_keminatan)->name;
            $newMahasiswa->foto_ktm = $mahasiswa->foto_ktm;
			$all->add($newMahasiswa);
		}

        return $all;
    }
}