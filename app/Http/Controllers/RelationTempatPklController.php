<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\RelationTempatPkl;
use App\Mahasiswa;
use App\TempatPkl;

class RelationTempatPklController extends Controller
{
    public function __construct(){
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showFavoriteTempatPkl(){
        return RelationTempatPkl::with('tempat_pkl.lokasi_pkl', 
        'tempat_pkl.relation_bidang_kerja.bidang_kerja', 'tempat_pkl.count_ulasan_tempat_pkl')->
        where('is_favorite', 1)->paginate(20);
    }

    public function toggleFavoriteTempatPkl($id_tempat_pkl)
    {
        if (!RelationTempatPkl::where('id_mahasiswa', auth()->user()->id)->where('id_tempat_pkl', $id_tempat_pkl)
            ->where('is_favorite', 0)->Get()->isEmpty()) {
            $relation = RelationTempatPkl::where('id_mahasiswa', auth()->user()->id)->where('id_tempat_pkl', $id_tempat_pkl)->first();
            $relation->is_favorite = 1;
            $relation->save();
        } elseif (!RelationTempatPkl::where('id_mahasiswa', auth()->user()->id)->where('id_tempat_pkl', $id_tempat_pkl)
            ->where('is_favorite', 1)->Get()->isEmpty()) {
            $relation = RelationTempatPkl::where('id_mahasiswa', auth()->user()->id)->where('id_tempat_pkl', $id_tempat_pkl)->first();
            $relation->is_favorite = 0;
            $relation->save();
        } else {
            $relation = new RelationTempatPkl();
            $relation->id_mahasiswa = auth()->user()->id;
            $relation->id_tempat_pkl = $id_tempat_pkl;
            $relation->is_favorite = 1;
            $relation->save();
        }
        return RelationTempatPkl::where('id_mahasiswa', auth()->user()->id)->where('id_tempat_pkl', $id_tempat_pkl)->first();
    }
}
