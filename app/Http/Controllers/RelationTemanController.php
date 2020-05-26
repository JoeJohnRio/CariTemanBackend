<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\RelationTeman;
use App\Mahasiswa;
use App\Notifikasi;

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

    public function showFriendNameOnly(){
        $mahasiswa = RelationTeman::with("mahasiswa")->where('id_mahasiswa_one', auth()->user()->id)->where('status', 1)->get();
        
        return $mahasiswa->pluck('mahasiswa');
    }

    public function addFriend(request $request)
    {
        $relationFirst = new RelationTeman();
        $relationFirst->id_mahasiswa_one = auth()->user()->id;
        $relationFirst->id_mahasiswa_two = $request->id_mahasiswa_two;
        $relationFirst->status = 2;
        $relationFirst->save();
        
        $relationSecond = new RelationTeman();
        $relationSecond->id_mahasiswa_one = $request->id_mahasiswa_two;
        $relationSecond->id_mahasiswa_two = auth()->user()->id;
        $relationSecond->status = 2;
        $relationSecond->save();
        
        $notifikasi = new Notifikasi();
        $notifikasi->notifikasi_type = 1;
        $notifikasi->id_mahasiswa_pengirim = auth()->user()->id;
        $notifikasi->id_mahasiswa_penerima = $request->id_mahasiswa_two;
        $notifikasi->save();
    
        return response()->json(['message' => 'Menunggu persetujuan pertemanan']);
    }

    public function confirmFriend(request $request){
        $relationFirst = RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $request->id_mahasiswa_two)->first();;
        $relationFirst->status = $request->status;
        $relationFirst->save();
        
        $relationFirst = RelationTeman::where('id_mahasiswa_two', auth()->user()->id)->where('id_mahasiswa_one', $request->id_mahasiswa_two)->first();
        $relationFirst->status = $request->status;
        $relationFirst->save();

        $notifikasi = new Notifikasi();
        if($request->status == 0){
            $notifikasi->notifikasi_type = 3;
        }else if ($request->status == 1){
            $notifikasi->notifikasi_type = 2;
        }
        $notifikasi->id_mahasiswa_pengirim = auth()->user()->id;
        $notifikasi->id_mahasiswa_penerima = $request->id_mahasiswa_two;
        $notifikasi->save();

        $notifikasiIsRead = Notifikasi::where('id_mahasiswa_pengirim', $request->id_mahasiswa_two)->where('id_mahasiswa_penerima', auth()->user()->id)->
        where('notifikasi_type',1)->first();
        $notifikasiIsRead->is_read = 1;
        $notifikasiIsRead->save();    
        
        return response()->json(['message' => 'Sudah terkirim']);
    }


    public function showFavoriteFriendPkl()
    {
        return RelationTeman::with('mahasiswa_two_pkl.count_rekomendasi', 
        'mahasiswa_two_pkl.pengalaman_lomba', 
        'mahasiswa_two_pkl.pengalaman_organisasi.relation_bidang_kerja.bidang_kerja')->
        where('id_mahasiswa_one', auth()->user()->id)->where('is_favorite', 1)->paginate(20);
    }

    public function showFavoriteFriendLomba()
    {
        return RelationTeman::with('mahasiswa_two_lomba.count_rekomendasi', 
        'mahasiswa_two_lomba.pengalaman_lomba', 
        'mahasiswa_two_lomba.pengalaman_organisasi.relation_bidang_kerja.bidang_kerja')->
        where('id_mahasiswa_one', auth()->user()->id)->where('is_favorite', 1)->paginate(20);
    }

    public function getRelationTeman($id_two){
        $relationMahasiswa = RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->
        where('id_mahasiswa_two', $id_two)->get();

        if($relationMahasiswa->isEmpty()){
            $relation = new RelationTeman();
            $relation->id_mahasiswa_one = auth()->user()->id;
            $relation->id_mahasiswa_two = $id_two;
            $relation->is_favorite = 0;
            $relation->status = 0;
            $relation->save();
            
            return RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->
            where('id_mahasiswa_two', $id_two)->get();
        }

        return $relationMahasiswa;
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
            $relation->status = 0;
            $relation->save();
        }
        return RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id_two)->first();
    }
}
