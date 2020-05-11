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
    public function getTempatPkl(){
        return TempatPkl::with('relation_bidang_kerja.bidang_kerja', 'lokasi_pkl')->get();
    }
}
