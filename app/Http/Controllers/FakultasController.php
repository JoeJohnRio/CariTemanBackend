<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\Fakultas;
use App\ProgramStudi;
use App\Keminatan;


class FakultasController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function index()
    {
        return Fakultas::all();
    }

    public function showProgramStudiById($id)
    {
        return ProgramStudi::where('id_fakultas', $id);
    }

    public function showKeminatanById($id)
    {
        return Keminatan::where('id_program_studi', $id);;
    }
}
