<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\Fakultas;
use App\ProgramStudi;
use App\Keminatan;


class FakultasController extends Controller{

    
public function index(){
    return Fakultas::all();
}

public function showProgramStudiById($id){
    return ProgramStudi::find($id);
}

public function showKeminatanById($id){
    return Keminatan::find($id);
}





}
