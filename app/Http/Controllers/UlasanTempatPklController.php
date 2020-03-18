<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryLihatTempatPkl;
use App\UlasanTempatPkl;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
            return "sudah pernah memasukkan";
        }
        $ulasanTempatPkl->ulasan = $request->ulasan;
        $ulasanTempatPkl->id_tempat_pkl = $request->id_tempat_pkl;
        $ulasanTempatPkl->id_pengirim = auth()->user()->id;
        $ulasanTempatPkl->save();

        return "Ulasan ditambahkan";
    }

    public function showUlasanTempatPkl(){
        $history = UlasanTempatPkl::where('id_tempat_pkl', auth()->user()->id)->
        orderBy('created_at','desc')->get()->take(5);

        return $history;
    }
}
