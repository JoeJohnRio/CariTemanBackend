<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryLihatTempatPkl;
use App\Mahasiswa;
use App\TempatPkl;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HistoryLihatTempatPklController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function saveHistoryLihatProfil($id_tempat_pkl){
        $history = new HistoryLihatTempatPkl();
        $history->id_mahasiswa = auth()->user()->id;
        $history->id_tempat_pkl = $id_tempat_pkl;
        $history->save();
    }

    public function showHistoryLihatDashboardTempatPkl(){
        $history = HistoryLihatTempatPkl::with('tempat_pkl', 'tempat_pkl.bidang_kerja',
         'tempat_pkl.lokasi_pkl', 'tempat_pkl.count_ulasan_tempat_pkl')->where('id_mahasiswa', auth()->user()->id)->
        orderBy('created_at','desc')->get()->take(5);

        return $history;
    }

    public function showHistoryLihatTempatPkl(){
        $history = HistoryLihatTempatPkl::with('tempat_pkl', 'tempat_pkl.relation_tempat_pkl', 
        'tempat_pkl.relation_bidang_kerja.bidang_kerja', 'tempat_pkl.lokasi_pkl', 'tempat_pkl.count_ulasan_tempat_pkl')->
        where('id_mahasiswa', auth()->user()->id)->orderBy('created_at','desc');

        return $history->paginate(20);
    }

    public function paginate($items, $perPage, $page, $options){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    
}
