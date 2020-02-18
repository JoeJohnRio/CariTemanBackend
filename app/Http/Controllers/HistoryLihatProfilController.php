<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryLihatProfil;
use App\Mahasiswa;
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
        $history = HistoryLihatProfil::with('mahasiswa_two_lomba')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->get()->where('mahasiswa_two_lomba', '!=', NULL);

        return $this->paginate($history, $perPage = 5, $page = null, $options = []);
    }
    
    public function showHistoryLihatProfilDashboardLomba(){
        $history = HistoryLihatProfil::with('mahasiswa_two_lomba')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->get()->where('mahasiswa_two_lomba', '!=', NULL)->take(5);

        return $history;
    }

    public function showHistoryLihatProfilPkl(){
        $history = HistoryLihatProfil::with('mahasiswa_two_pkl')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->get()->where('mahasiswa_two_pkl', '!=', NULL);

        return $this->paginate($history, $perPage = 5, $page = null, $options = []);
    }
    
    public function showHistoryLihatProfilDashboardPkl()
    {
        $history = HistoryLihatProfil::with('mahasiswa_two_pkl')->where('id_mahasiswa_one', auth()->user()->id)->
        orderBy('created_at','desc')->get()->where('mahasiswa_two_pkl', '!=', NULL)->take(5);

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
