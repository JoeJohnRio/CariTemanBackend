<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekomendasi;
use App\RelationTeman;
use App\RelationKelompok;
use App\Mahasiswa;

class RekomendasiController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showRekomendasiMahasiswa(){
        $history = Rekomendasi::with('data_pengirim')->where('id_penerima', auth()->user()->id)->orderBy('created_at','desc')->get();
        return $history;
    }

    public function saveRekomendasiMahasiswa(request $request){
        $rekomendasi = new Rekomendasi();
        $rekomendasi->jumlah_rating = $request->jumlah_rating;
        $rekomendasi->deskripsi = $request->deskripsi;
        $rekomendasi->is_hidden = false;
        $rekomendasi->id_pengirim = auth()->user()->id;
        $rekomendasi->id_penerima = $request->id_penerima;
        if(Rekomendasi::where('id_pengirim', auth()->user()->id)->where('id_penerima', $request->id_penerima)->exists()){
            return "Sudah pernah mengisi rekomendasi";
        }else{
            $rekomendasi->save();
            return "Rekomendasi masuk";
        }
    }

    public function setRekomendasiHiddenTrue(request $request){
        // $rekomendasi = new Rekomendasi();
        $rekomendasi = Rekomendasi::where('id_pengirim', $request->id_pengirim)->where('id_penerima', auth()->user()->id)->first();
        $rekomendasi->is_hidden = true;
        $rekomendasi->save();
    }

    public function setRekomendasiHiddenFalse(request $request){
        // $rekomendasi = new Rekomendasi();
        $rekomendasi = Rekomendasi::where('id_pengirim', $request->id_pengirim)->where('id_penerima', auth()->user()->id)->first();
        $rekomendasi->is_hidden = true;
        $rekomendasi->save();
    }

    public function profilInfoOthers($id){
        $teman = Mahasiswa::where('id', $id)->first();
        $relasiTeman = RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->
        where('id_mahasiswa_two', $id)->first();

        return response()->json(
            ['name' => $teman->value('name'),
            'tahun_mulai' => $teman->value('tahun_mulai'),
            'foto_profil' => $teman->value('foto_profil'),
            'status' => $relasiTeman->value('status'),
            'is_favorite' => $relasiTeman->count('is_favorite'),
            'jumlah_teman' => RelationTeman::where('id_mahasiswa_one', $id)->count(),
            'jumlah_rekomendasi' => Rekomendasi::where('id_penerima', $id)->count(),
            'jumlah_kelompok' => RelationKelompok::where('id_mahasiswa', $id)->count()]
        );
    }
}
