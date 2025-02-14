<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\PengalamanLomba;
use App\PengalamanOrganisasi;
use App\Rekomendasi;
use App\RelationBidangKerja;


class PengalamanController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    // public function getPengalamanLomba(){
    //     $pengalaman = PengalamanLomba::with('relation_bidang_kerja', 'relation_bidang_kerja.bidang_kerja')
    //     ->where('id_mahasiswa', auth()->user()->id)->orderBy('tanggal','desc')->get();
    //     return $pengalaman;
    // }

    // public function getPengalamanOrganisasi(){
    //     $pengalaman = PengalamanOrganisasi::with('relation_bidang_kerja', 'relation_bidang_kerja.bidang_kerja')
    //     ->where('id_mahasiswa', auth()->user()->id)->orderBy('tanggal_mulai','desc')->get();
    //     return $pengalaman;
    // }

    public function getPengalamanLombaDanOrganisasiDanRekomendasi($id){
        $pengalamanLomba = PengalamanLomba::with('relation_bidang_kerja.bidang_kerja')
        ->where('id_mahasiswa', $id)->orderBy('tanggal','desc')->get();
        
        $pengalamanOrganisasi = PengalamanOrganisasi::with('relation_bidang_kerja.bidang_kerja')
        ->where('id_mahasiswa', $id)->orderBy('tanggal_mulai','desc')->get();

        $rekomendasi = Rekomendasi::with('data_mahasiswa')->where('id_penerima', $id)->get();
        
        // return Mahasiswa::where('id', $rekomendasi->id_pengirim)->first();
        
        //nama, rating, isi rekomendasi, gambar

        return response()->json(
            ['rekomendasi' => $rekomendasi,
            'pengalaman' => 
            ['pengalaman_lomba' => $pengalamanLomba,
            'pengalaman_organisasi' => $pengalamanOrganisasi]
            ]);
    }

    public function getPengalamanLombaDanOrganisasiDanRekomendasiItself(){
        $pengalamanLomba = PengalamanLomba::with('relation_bidang_kerja.bidang_kerja')
        ->where('id_mahasiswa', auth()->user()->id)->orderBy('tanggal','desc')->get();
        
        $pengalamanOrganisasi = PengalamanOrganisasi::with('relation_bidang_kerja.bidang_kerja')
        ->where('id_mahasiswa', auth()->user()->id)->orderBy('tanggal_mulai','desc')->get();

        $rekomendasi = Rekomendasi::with('data_mahasiswa')->where('id_penerima', auth()->user()->id)->get();
        
        // return Mahasiswa::where('id', $rekomendasi->id_pengirim)->first();
        
        //nama, rating, isi rekomendasi, gambar

        return response()->json(
            ['rekomendasi' => $rekomendasi,
            'pengalaman' => 
            ['pengalaman_lomba' => $pengalamanLomba,
            'pengalaman_organisasi' => $pengalamanOrganisasi]
            ]);
    }

    public function getPengalamanLombaDanOrganisasi(){
        $pengalamanLomba = PengalamanLomba::with('relation_bidang_kerja.bidang_kerja')
        ->where('id_mahasiswa', auth()->user()->id)->orderBy('tanggal','desc')->get();
        
        $pengalamanOrganisasi = PengalamanOrganisasi::with('relation_bidang_kerja.bidang_kerja')
        ->where('id_mahasiswa', auth()->user()->id)->orderBy('tanggal_mulai','desc')->get();

        return response()->json(
            ['pengalaman_lomba' => $pengalamanLomba,
            'pengalaman_organisasi' => $pengalamanOrganisasi
            ]);
    }

    public function savePengalamanLomba(request $request){
        $pengalaman = new PengalamanLomba();

        $pengalaman->nama_kompetisi = $request->nama_kompetisi;
        $pengalaman->deskripsi = $request->deskripsi;
        $pengalaman->id_mahasiswa = auth()->user()->id;
        $pengalaman->tanggal = $request->tanggal;
        $pengalaman->gambar = $request->gambar;
        $pengalaman->save();

        // return response()->json(
        //     ['pengalaman_lomba' => $pengalamanLomba,
    }
    
    public function savePengalamanOrganisasi(request $request){
        $pengalaman = new PengalamanOrganisasi();

        $pengalaman->nama_organisasi = $request->nama_organisasi;
        $pengalaman->deskripsi = $request->deskripsi;
        $pengalaman->tanggal_mulai = $request->tanggal_mulai;
        $pengalaman->tanggal_selesai = $request->tanggal_selesai;
        $pengalaman->id_mahasiswa = auth()->user()->id;
        $pengalaman->id_bidang_kerja = $request->id_bidang_kerja;
        $pengalaman->save();

        return "Pengalaman organisasi sudah ditambahkan";
    }

    public function modifyPengalamanLomba(request $request){

        if($request->id_pengalaman_lomba == 0){
            $pengalaman = new PengalamanLomba;
            
            $pengalaman->id_mahasiswa = auth()->user()->id;
            $pengalaman->nama_kompetisi = $request->nama_kompetisi;
            $pengalaman->deskripsi = $request->deskripsi;
            $pengalaman->gambar = $request->gambar;
            $pengalaman->tanggal = $request->tanggal;
            $pengalaman->save();
            
            $relationBidangKerja = new RelationBidangKerja;
            $relationBidangKerja->id_pengalaman_lomba = $pengalaman->id;
            $relationBidangKerja->id_bidang_kerja = $request->id_bidang_kerja; 
            $relationBidangKerja->id_mahasiswa = auth()->user()->id; 
            $relationBidangKerja->save();
        }else{
            $pengalaman = PengalamanLomba::find($request->id_pengalaman_lomba);
            
            $pengalaman->id_mahasiswa = auth()->user()->id;
            $pengalaman->nama_kompetisi = $request->nama_kompetisi;
            $pengalaman->deskripsi = $request->deskripsi;
            $pengalaman->gambar = $request->gambar;
            $pengalaman->tanggal = $request->tanggal;
            $pengalaman->save();
            
            $relationBidangKerja = RelationBidangKerja::where('id_pengalaman_lomba', $request->id_pengalaman_lomba)->first();
            if($request->id_bidang_kerja != 0){
                $relationBidangKerja->id_bidang_kerja = $request->id_bidang_kerja; 
            }
            $relationBidangKerja->save();
        }
        
        return $pengalaman;
    }

    public function modifyPengalamanOrganisasi(request $request){
        if($request->id_pengalaman_organisasi == 0){
            $pengalaman = new PengalamanOrganisasi;
            
            $pengalaman->id_mahasiswa = auth()->user()->id;
            $pengalaman->nama_organisasi = $request->nama_organisasi;
            $pengalaman->deskripsi = $request->deskripsi;
            $pengalaman->gambar = $request->gambar;
            $pengalaman->tanggal_mulai = $request->tanggal_mulai;
            $pengalaman->tanggal_selesai = $request->tanggal_selesai;
            $pengalaman->save();
            
            $relationBidangKerja = new RelationBidangKerja;
            $relationBidangKerja->id_pengalaman_organisasi = $pengalaman->id;
            $relationBidangKerja->id_bidang_kerja = $request->id_bidang_kerja; 
            $relationBidangKerja->id_mahasiswa = auth()->user()->id; 
            $relationBidangKerja->save();
        }else{
            $pengalaman = PengalamanOrganisasi::find($request->id_pengalaman_organisasi);
            
            $pengalaman->id_mahasiswa = auth()->user()->id;
            $pengalaman->nama_organisasi = $request->nama_organisasi;
            $pengalaman->deskripsi = $request->deskripsi;
            $pengalaman->gambar = $request->gambar;
            $pengalaman->tanggal_mulai = $request->tanggal_mulai;
            $pengalaman->tanggal_selesai = $request->tanggal_selesai;
            $pengalaman->save();
            
            $relationBidangKerja = RelationBidangKerja::where('id_pengalaman_organisasi', $request->id_pengalaman_organisasi)->first();
            if($request->id_bidang_kerja != 0){
                $relationBidangKerja->id_bidang_kerja = $request->id_bidang_kerja; 
            }
            $relationBidangKerja->save();
        }
        
        return $pengalaman;
    }

    public function deletePengalamanOrganisasi($id){
        $relationBidangKerja = RelationBidangKerja::where('id_pengalaman_organisasi', $id)->first();
        $relationBidangKerja->delete();

        $pengalaman = PengalamanOrganisasi::find($id);
        $pengalaman->delete();
        
        return PengalamanOrganisasi::find($id);
    }

    public function deletePengalamanLomba($id){
        $relationBidangKerja = RelationBidangKerja::where('id_pengalaman_lomba', $id)->first();
        $relationBidangKerja->delete();

        $pengalaman = PengalamanLomba::find($id);
        $pengalaman->delete();

        return PengalamanLomba::find($id);
    }
}
