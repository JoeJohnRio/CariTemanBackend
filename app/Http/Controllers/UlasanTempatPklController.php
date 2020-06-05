<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UlasanTempatPkl;
use App\Mahasiswa;

class UlasanTempatPklController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function saveUlasanTempatPkl(request $request){
        $ulasanTempatPkl = new UlasanTempatPkl();
        $ulasanCheck = UlasanTempatPkl::where('id_tempat_pkl', $request->id_tempat_pkl)
        ->where('id_pengirim', auth()->user()->id)->first();
        if($ulasanCheck != null){
            return response()->json(['message' => "sudah pernah memasukkan"]);
        }
        $ulasanTempatPkl->ulasan = $request->isi_ulasan;
        $ulasanTempatPkl->id_tempat_pkl = $request->id_tempat_pkl;
        $ulasanTempatPkl->id_pengirim = auth()->user()->id;
        $ulasanTempatPkl->save();

        return response()->json(['message' => "Ulasan ditambahkan"]);
    }

    public function showUlasanTempatPkl($id){
        $allUlasan = UlasanTempatPkl::where('id_tempat_pkl', $id)->get();

        $all = collect();

        foreach ($allUlasan as $one_ulasan) {
            $mahasiswa= Mahasiswa::where('id', $one_ulasan->id_pengirim)->first();
            $ulasanTempatPkl = new Mahasiswa();
            $ulasanTempatPkl->nama_pengirim = $mahasiswa->name;
            $ulasanTempatPkl->gambar_pengirim = $mahasiswa->foto_profil;
            $ulasanTempatPkl->isi_ulasan = $one_ulasan->ulasan;
            $all->add($ulasanTempatPkl);
        }
        return $all;
    }
}
