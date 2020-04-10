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

    public function showFavoriteFriend($id)
    {
        return RelationTeman::where('id_mahasiswa_one', $id)->where('is_favorite', 1)->Get();
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
