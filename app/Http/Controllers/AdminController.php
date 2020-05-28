<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use Illuminate\Http\Request;
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

    public function mahasiswaNeedVerificationDetail(request $request){
        
		$all = collect();
        $mahasiswa = Mahasiswa::find($request->id);
        $newMahasiswa = new Mahasiswa();
            
        $newMahasiswa->id = $mahasiswa->id;
        $newMahasiswa->name = $mahasiswa->name;
        $newMahasiswa->tahun_mulai = $mahasiswa->tahun_mulai;
        $newMahasiswa->nim = $mahasiswa->nim;
        $newMahasiswa->email = $mahasiswa->email;
        $newMahasiswa->preferensi = $mahasiswa->preferensi;
        $newMahasiswa->jenis_kelamin = $mahasiswa->jenis_kelamin;
        $newMahasiswa->foto_profil = $mahasiswa->foto_profil;
        $newMahasiswa->fakultas = Fakultas::find($mahasiswa->id_fakultas)->name;
        $newMahasiswa->program_studi = ProgramStudi::find($mahasiswa->id_program_studi)->name;
        $newMahasiswa->keminatan = Keminatan::find($mahasiswa->id_keminatan)->name;
        $newMahasiswa->foto_ktm = $mahasiswa->foto_ktm;

        return $newMahasiswa;
    }

    public function confirmVerificationMahasiswa(request $request){
        $mahasiswa = Mahasiswa::find($request->id);

        if($request->status == 1){
            $mahasiswa->is_verified = 1;
            $mahasiswa->save();
            
            return "mahasiswa sudah terverifikasi";
        }else{
            $mahasiswa->delete();
            
            return "mahasiswa dihapus dari database";
        }

    }
}