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
        $history = HistoryLihatProfil::with('mahasiswa_two_lomba.count_pengalaman')->
        with('mahasiswa_two_lomba.pengalaman_lomba')->
        with('mahasiswa_two_lomba.pengalaman_organisasi')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->paginate(10);

        return $history;
    }
    
    public function showHistoryLihatProfilDashboardLomba(){
        $history = HistoryLihatProfil::with('mahasiswa_two_lomba.count_pengalaman')->
        with('mahasiswa_two_lomba.pengalaman_lomba')->
        with('mahasiswa_two_lomba.pengalaman_organisasi')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->get();

        return $history;
    }

    public function showHistoryLihatProfilPkl(){
        $history = HistoryLihatProfil::with('mahasiswa_two_lomba.count_pengalaman')->
        with('mahasiswa_two_pkl.pengalaman_lomba')->
        with('mahasiswa_two_pkl.pengalaman_organisasi')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->get();

        return $this->paginate($history, $perPage = 10, $page = null, $options = []);
    }
    
    public function showHistoryLihatProfilDashboardPkl()
    {
        $history = HistoryLihatProfil::with('mahasiswa_two_lomba.count_pengalaman')->
        with('mahasiswa_two_pkl.pengalaman_lomba')->
        with('mahasiswa_two_pkl.pengalaman_organisasi')->where('id_mahasiswa_one', auth()->user()->id)->
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
