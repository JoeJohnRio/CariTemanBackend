<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\TempatPkl;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function searchMahasiswa(request $request){
        $keyword = $request->keyword;

        $user = Mahasiswa::where('is_verified',1)->where('name', 'like', "%".$keyword."%");

        // $user = new Mahasiswa();

        if ($request->has('jenis_kelamin')) {
            $user->where('jenis_kelamin', $request->input('jenis_kelamin'));
        }

        if ($request->has('id_fakultas')) {
            $user->where('id_fakultas', $request->input('id_fakultas'));
        }

        if ($request->has('id_fakultas', 'id_program_studi')) {
            $user->where('id_fakultas', $request->input('id_fakultas'))->where('id_program_studi', $request->input('id_program_studi'));
        }

        if ($request->has('id_fakultas', 'id_program_studi', 'id_keminatan')){
            $user->where('id_fakultas', $request->input('id_fakultas'))->where('id_program_studi'
            , $request->input('id_program_studi'))->where('id_keminatan', $request->input('id_keminatan'));
        }

        if ($request->has('tahun_mulai')) {
            $user->where('tahun_mulai', $request->input('tahun_mulai'));
        }

        // if ($request->has('bidang_kerja')) {
        //     $splitBidangKerja = explode('99', $request, 3); // Restricts it to only 2 values, for names like Billy Bob Jones

        //     $bidangKerja1 = $splitBidangKerja[0];
        //     $bidangKerja2 = !empty($splitBidangKerja[1]) ? $splitBidangKerja[1] : null; 
        //     $bidangKerja3 = !empty($splitBidangKerja[2]) ? $splitBidangKerja[2] : null; 
        // }

        return $user->get();
        }
    }



