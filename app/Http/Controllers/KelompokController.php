<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\Mahasiswa;
use App\Kelompok;
use App\RelationKelompok;
use Auth;


class KelompokController extends Controller
{
    public function __construct(){
        config()->set( 'auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showKelompok(){
        $kelompok =  RelationKelompok::with('kelompok')->where('id_mahasiswa', auth()->user()->id)->get();
        return $kelompok;
    }

    public function inviteAnggota(request $request){
        $anggota = new RelationKelompok;
        $anggota->id_kelompok = $request->id_kelompok;
        $anggota->id_mahasiswa = $request->id_mahasiswa;
        $anggota->status = 0;
        $anggota->save();

        return "anggota sudah diinvite";
    }

    public function makeKelompok(request $request){
        $kelompok = new Kelompok;
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->jumlah_anggota = $request->jumlah_anggota;
        $kelompok->tipe_kelompok = $request->tipe_kelompok;
        $kelompok->foto_kelompok = $request->foto_kelompok;
        $kelompok->save();
        return $request->calon_anggotas;
        foreach ($request->calon_anggotas as $calon_anggota) {
            $anggota = new RelationKelompok;
            return $calon_anggota->id_mahasiswa;
            $anggota->id_kelompok = $kelompok->id;
            $anggota->id_mahasiswa = $calon_anggota->id_mahasiswa;
            $anggota->status = 0;
            $anggota->save();
            }

    }

    public function confirmAnggotaKelompok(request $request){
        $anggota = RelationKelompok::where('id_kelompok', $request->id_kelompok)->
        where('id_mahasiswa', auth()->user()->id)->first();
        $anggota->status = 1;
        $anggota->save();

        $kelompok = Kelompok::find($request->id_kelompok);
        $kelompok->jumlah_anggota = $kelompok->jumlah_anggota + 1;
        $kelompok->save();

        return "Anda sudah masuk dalam kelompok";
    }

    public function updateKelompokInfo(request $request){
        $kelompok = Kelompok::where('id',$request->id_kelompok)->first();
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->tipe_kelompok = $request->tipe_kelompok;
        $kelompok->foto_kelompok = $request->foto_kelompok;

        $kelompok->save();

        return "data kelompok sudah diupdate";
    }

    public function deleteAnggota(request $request){
        $mahasiswa = RelationKelompok::where('id_kelompok', $request->id_kelompok)
        ->where('id_mahasiswa', $request->id_mahasiswa)->first();
        $mahasiswa->delete();

        return "Data berhasil dihapus";
    }

    public function showPendingMember(request $request){
        $anggota = RelationKelompok::with('pendingMember')->where('id_kelompok', $request->id_kelompok)
        ->where('status', 0)->get();
        return $anggota;
    }

}