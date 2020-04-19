<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\PengalamanLomba;
use App\PengalamanOrganisasi;
use App\Rekomendasi;
use App\Mahasiswa;


class PengalamanController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function getPengalamanLomba(){
        $pengalaman = PengalamanLomba::with('relation_bidang_kerja', 'relation_bidang_kerja.bidang_kerja')
        ->where('id_mahasiswa', auth()->user()->id)->orderBy('tanggal','desc')->get();
        return $pengalaman;
    }

    public function getPengalamanOrganisasi(){
        $pengalaman = PengalamanOrganisasi::with('relation_bidang_kerja', 'relation_bidang_kerja.bidang_kerja')
        ->where('id_mahasiswa', auth()->user()->id)->orderBy('tanggal_mulai','desc')->get();
        return $pengalaman;
    }

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
        $pengalaman->id_mahasiswa = $request->id_mahasiswa;
        $pengalaman->tanggal = $request->tanggal;
        $pengalaman->save();

        return "Pengalaman lomba sudah ditambahkan";
    }
    
    public function savePengalamanOrganisasi(request $request){
        $pengalaman = new PengalamanOrganisasi();

        $pengalaman->nama_organisasi = $request->nama_organisasi;
        $pengalaman->deskripsi = $request->deskripsi;
        $pengalaman->tanggal_mulai = $request->tanggal_mulai;
        $pengalaman->tanggal_selesai = $request->tanggal_selesai;
        $pengalaman->id_mahasiswa = $request->id_mahasiswa;
        $pengalaman->id_bidang_kerja = $request->id_bidang_kerja;
        $pengalaman->save();

        return "Pengalaman organisasi sudah ditambahkan";
    }

    public function modifyPengalamanLomba(request $request, $id){
        $pengalaman = PengalamanLomba::find($id);

        $pengalaman->nama_kompetisi = $request->nama_kompetisi;
        $pengalaman->deskripsi = $request->deskripsi;
        $pengalaman->gambar = $request->gambar;
        $pengalaman->tanggal = $request->tanggal;
        $pengalaman->save();

        return "Pengalaman lomba sudah diubah";
    }

    public function modifyPengalamanOrganisasi(request $request, $id){
        $pengalaman = PengalamanOrganisasi::find($id);

        $pengalaman->nama_organisasi = $request->nama_organisasi;
        $pengalaman->deskripsi = $request->deskripsi;
        $pengalaman->gambar = $request->gambar;
        $pengalaman->tanggal_mulai = $request->tanggal_mulai;
        $pengalaman->tanggal_selesai = $request->tanggal_selesai;
        $pengalaman->id_bidang_kerja = $request->id_bidang_kerja;
        $pengalaman->save();

        return "Pengalaman organisasi sudah diubah";
    }

    public function deletePengalamanOrganisasi(request $request, $id){
        $pengalaman = PengalamanOrganisasi::find($id);
        $pengalaman->delete();

        return "Pengalaman organisasi sudah dihapus";
    }

    public function deletePengalamanLomba(request $request, $id){
        $pengalaman = PengalamanLomba::find($id);
        $pengalaman->delete();

        return "Pengalaman lomba sudah dihapus";
    }
}
