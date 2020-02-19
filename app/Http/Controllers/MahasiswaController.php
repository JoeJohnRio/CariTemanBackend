<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\Mahasiswa;
use Auth;


class MahasiswaController extends Controller
{
    public function __construct(){
        config()->set( 'auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function index()
    {
        return Mahasiswa::all();
    }

    public function create(request $request)
    {
        $mahasiswa = new Mahasiswa;
        $mahasiswa->email = $request->email;
        $mahasiswa->password = $request->password;
        $mahasiswa->save();
        return "Data berhasil masuk";
    }

    public function mahasiswa()
    {
        $data = "Data All Book";
        return response()->json($data, 200);
    }

    public function mahasiswaAuth()
    {
        $data = "Welcome " . Auth::user()->name;
        return response()->json($data, 200);
    }

    public function mahasiswaKe($id)
    {
        return Mahasiswa::find($id);
    }

    public function delete($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return "Data berhasil dihapus";
    }

    public function update(request $request, $id)
    {


        $email = $request->email;
        $password = $request->password;

        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->email = $email;
        $mahasiswa->password = $password;
        $mahasiswa->save();
        // $mahasiswa->email = $request->email;
        // $mahasiswa->password = $request->password;
        // $mahasiswa->nama = $request->nama;
        // $mahasiswa->save();

        return "Data berhasil diganti";
    }
}