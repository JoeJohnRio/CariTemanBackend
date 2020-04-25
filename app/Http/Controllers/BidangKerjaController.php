<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\BidangKerja;


class BidangKerjaController extends Controller
{

    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showSearchBidangKerja($namaBidangKerja){
        return BidangKerja::where('nama_bidang_kerja', $namaBidangKerja)
        ->orWhere('nama_bidang_kerja', 'like', '%' .  $namaBidangKerja . '%')->get();
    }

    public function makeBidangKerja($namaBidangKerja){
        $bidangKerjaMake = new BidangKerja();
        $bidangKerjaMake->nama_bidang_kerja = $namaBidangKerja;
        $bidangKerjaMake->save();

        return BidangKerja::where('nama_bidang_kerja', $namaBidangKerja)->get();
    }
}
