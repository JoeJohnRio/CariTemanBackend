<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\BidangKerja;
use App\LokasiPkl;
use App\RelationBidangKerja;
use App\RelationLokasiPkl;
use App\TempatPkl;
use App\UlasanTempatPkl;


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

    public function showTempatPklProfile($id){
        $tempatPkl = TempatPkl::where('id', $id)->first();

            $lokasiPkl = LokasiPkl::where('id', RelationLokasiPkl::where('id_tempat_pkl', $id)->first()->id_lokasi_pkl)->first()->nama_kota;
            $jumlahUlasan = UlasanTempatPkl::where('id_tempat_pkl', $id)->count();

            $tempatPklReturn = new TempatPkl();
            $tempatPklReturn->nama_perusahaan = $tempatPkl->nama_perusahaan;
            $tempatPklReturn->gambar = $tempatPkl->gambar;
            $tempatPklReturn->phone_number = $tempatPkl->phone_number;
            $tempatPklReturn->lokasi_pkl = $lokasiPkl;
            $tempatPklReturn->jumlah_ulasan = $jumlahUlasan;

        return $tempatPklReturn;
    }

    public function addTempatPkl(request $request){

        $tempatPkl = new TempatPkl();
        $tempatPkl->nama_perusahaan = $request->nama_perusahaan;
        $tempatPkl->gambar = $request->gambar;
        $tempatPkl->phone_number = $request->phone_number;
        $tempatPkl->id_lokasi_pkl = $request->id_lokasi_pkl;
        
        $tempatPkl->save();
        
        $relationBidangKerja = new RelationBidangKerja();
        $relationBidangKerja->id_bidang_kerja = $request->id_bidang_kerja;
        $relationBidangKerja->id_tempat_pkl = $tempatPkl->id;
        $relationBidangKerja->save();

        $relationTempatPkl = new RelationLokasiPkl();
        $relationTempatPkl->id_lokasi_pkl = $request->id_lokasi_pkl;
        $relationTempatPkl->id_tempat_pkl = $tempatPkl->id;
        $relationTempatPkl->save();


        return response()->json(
			['message' => "Tempat Ditambah"]
		);
    }
}
