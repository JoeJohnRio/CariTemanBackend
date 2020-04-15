<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryLihatProfil;
use App\Mahasiswa;
use App\TempatPkl;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HistoryLihatProfilController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showHistoryLihatProfilLomba(){
        $history = HistoryLihatProfil::with('mahasiswa_two_lomba.count_rekomendasi', 
        'mahasiswa_two_lomba.pengalaman_lomba', 
        'mahasiswa_two_lomba.pengalaman_organisasi.relation_bidang_kerja.bidang_kerja',
        'mahasiswa_two_lomba.relation_teman')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->paginate(20);

        return $history;
    }
    
    public function showHistoryLihatProfilDashboardLomba(){
        $history = HistoryLihatProfil::with('mahasiswa_two_lomba.count_rekomendasi')->
        with('mahasiswa_two_lomba.pengalaman_lomba')->
        with('mahasiswa_two_lomba.pengalaman_organisasi')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->get();

        return $history;
    }

    public function showHistoryLihatProfilPkl(){
        $history = HistoryLihatProfil::with('mahasiswa_two_pkl.count_rekomendasi', 
        'mahasiswa_two_pkl.pengalaman_lomba', 
        'mahasiswa_two_pkl.pengalaman_organisasi.relation_bidang_kerja.bidang_kerja',
        'mahasiswa_two_pkl.relation_teman')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->paginate(20);

        return $history;
    }
    
    public function showHistoryLihatProfilDashboardPkl()
    {
        $history = HistoryLihatProfil::with('mahasiswa_two_pkl.count_rekomendasi')->
        with('mahasiswa_two_pkl.pengalaman_lomba')->
        with('mahasiswa_two_pkl.pengalaman_organisasi.relation_bidang_kerja.bidang_kerja')->
        where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->get();

        return $history;
    }

    public function saveHistoryLihatProfil($id_mahasiswa_two){
        $history = new HistoryLihatProfil();
        $history->id_mahasiswa_one = auth()->user()->id;
        $history->id_mahasiswa_two = $id_mahasiswa_two;
        $history->save();
    }

    public function paginate($items, $perPage, $page, $options){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    
}
