<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\Fakultas;

class RelationTemanController extends Controller{

    
public function index(){
    return 
}

public function showProgramStudiById($id){
    return ProgramStudi::find($id);
}

public function showKeminatanById($id){
    return Keminatan::find($id);
}





}
