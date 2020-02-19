<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\BidangKerja;
use App\LokasiPkl;
use App\TempatPkl;


class TempatPklController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function getBidangKerja(){
        return BidangKerja::all();
    }

    public function getLokasiPkl(){
        return LokasiPkl::all();
    }
    // HistoryLihatTempatPkl::with('tempat_pkl', 'tempat_pkl.bidang_kerja')->where('id_mahasiswa', auth()->user()->id)->
    // orderBy('created_at','desc')->get()->take(5);
    public function getTempatPkl(){
        return TempatPkl::with('bidang_kerja', 'lokasi_pkl')->get();
    }

    

    
}
