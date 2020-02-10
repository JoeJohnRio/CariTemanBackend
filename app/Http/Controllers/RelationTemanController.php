<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\RelationTeman;
use App\Mahasiswa;

class RelationTemanController extends Controller{

    
public function index($id){
    return RelationTeman::where('id_mahasiswa_one', $id)->where('status', 1)->Get();
}

public function showFavoriteFriend($id){
    return RelationTeman::where('id_mahasiswa_one', $id)->where('status', 1)->where('is_favorite',1)->Get();
}

public function makeFavoriteFriend($id){
    
}
}
