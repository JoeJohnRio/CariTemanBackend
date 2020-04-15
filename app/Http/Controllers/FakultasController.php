<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\Fakultas;
use App\ProgramStudi;
use App\Keminatan;
use App\Mahasiswa;


class FakultasController extends Controller
{
    public function index()
    {
        return Fakultas::all();
    }

    public function showProgramStudiById($id)
    {
        return ProgramStudi::where('id_fakultas', $id)->get();
    }

    public function showKeminatanById($id)
    {
        return Keminatan::where('id_program_studi', $id)->get();
    }

    public function showFakultasProdiKeminatan($id){
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        // return $mahasiswa->id_fakultas;
        return response()->json(
            ['fakultas' => Fakultas::where('id', $mahasiswa->id_fakultas)->pluck('name'),
            'program_studi' => ProgramStudi::where('id', $mahasiswa->id_program_studi)->pluck('name'),
            'keminatan' => Keminatan::where('id', $mahasiswa->id_keminatan)->pluck('name')]
        );
    }

    public function tugas(request $request){
        if($request->password_baru == $request->confirm_password_baru){
            return response()->json(
                ['status' => 200,
                'message' => "Password berhasil diubah",
                'data' => [
                    'id' => $request->id,
                    "password_lama" => $request->password_lama,
                    "password_baru" => $request->password_baru,
                    "confirm_password_baru" => $request->confirm_password_baru,
                    "password" => $request->password_baru
                ]]
            ); 
        }
        return "salah";
    }
}
