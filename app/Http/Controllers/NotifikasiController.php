<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\RelationTeman;
use App\Mahasiswa;
use App\Notifikasi;

class NotifikasiController extends Controller
{

    public function __construct(){
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showNotifikasi()
    {
        $notifikasis = Notifikasi::where('id_mahasiswa_penerima', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        foreach($notifikasis as $notifikasi){
            $notifikasi->mahasiswa = Mahasiswa::where('id', $notifikasi->id_mahasiswa_pengirim)->first();
        }
        
        return $notifikasis;
    }
}
