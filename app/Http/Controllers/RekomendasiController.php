<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekomendasi;

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

    public function countBanyakRekomendasi(){
        return Rekomendasi::where('id_penerima', auth()->user()->id)->count();
    }
}
