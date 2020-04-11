<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\RelationTeman;
use App\Mahasiswa;

class RelationTemanController extends Controller
{

    public function __construct(){
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showFriend($id)
    {
        return RelationTeman::where('id_mahasiswa_one', $id)->where('status_pertemanan', 1)->get();
    }

    public function addFriend($id_one, $id_two)
    {
        $relation = new RelationTeman();
        $relation->id_mahasiswa_one = $id_one;
        $relation->id_mahasiswa_two = $id_two;
        $relation->status = 2;
        $relation->save();

        return RelationTeman::where('id_mahasiswa_one', $id_one)->where(
            [
                ['status', '>=', '1']
            ]
        )->Get();
    }

    public function showFavoriteFriendPkl($id)
    {
        return RelationTeman::with('mahasiswa_two_pkl.count_rekomendasi', 
        'mahasiswa_two_pkl.pengalaman_lomba', 'mahasiswa_two_pkl.pengalaman_organisasi.bidang_kerja')->
        where('id_mahasiswa_one', $id)->where('is_favorite', 1)->paginate(20);
    }

    public function showFavoriteFriendLomba($id)
    {
        return RelationTeman::with('mahasiswa_two_lomba.count_rekomendasi', 
        'mahasiswa_two_lomba.pengalaman_lomba', 'mahasiswa_two_lomba.pengalaman_organisasi.bidang_kerja')->
        where('id_mahasiswa_one', $id)->where('is_favorite', 1)->paginate(20);
    }


    public function toogleFavoriteFriend($id_two)
    {
        if (!RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id_two)
            ->where('is_favorite', 0)->Get()->isEmpty()) {
            $relation = RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id_two)->first();
            $relation->is_favorite = 1;
            $relation->save();
        } elseif (!RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id_two)
            ->where('is_favorite', 1)->Get()->isEmpty()) {
            $relation = RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id_two)->first();
            $relation->is_favorite = 0;
            $relation->save();
        } elseif (!RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id_two)
            ->where('is_favorite', 0)->where('status', 0)->Get()->isEmpty()) {
            RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id_two)->delete();
        } else {
            $relation = new RelationTeman();
            $relation->id_mahasiswa_one = auth()->user()->id;
            $relation->id_mahasiswa_two = $id_two;
            $relation->is_favorite = 1;
            $relation->save();
        }
        return RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id_two)->first();
    }
}
