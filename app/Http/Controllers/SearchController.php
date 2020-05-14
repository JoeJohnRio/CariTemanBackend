<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\RelationBidangKerja;
use App\TempatPkl;
use App\RelationSkillhobi;
use App\SearchHistory;

class SearchController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function addSearchHistory(request $request){
        $searchHistory = new SearchHistory();
        $searchHistory->name = $request->name;
        $searchHistory->search_type = $request->search_type;
        $searchHistory->id_tempat_pkl = $request->id_tempat_pkl;
        $searchHistory->id_mahasiswa = $request->id_mahasiswa;
        $searchHistory->id_owner_history = $request->id_owner_history;
        $searchHistory->save();

        return $searchHistory;
    }

    public function showSearchHistory(){
        return SearchHistory::where('id_owner_history', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
    }

    public function searchMahasiswa(request $request){
        $preferensi = $request->preferensi;
        if($preferensi==null){
            $preferensi = 0;
        }

        if($request->keyword != null){
            $searchHistory = new SearchHistory();
            $searchHistory->name = $request->keyword;
            $searchHistory->search_type = $request->preferensi;
            $searchHistory->id_owner_history = auth()->user()->id;
            $searchHistory->save();        
        }
        
        $keyword = $request->keyword;
            $user = Mahasiswa::with('pengalaman_lomba', 
            'pengalaman_organisasi.relation_bidang_kerja.bidang_kerja',
            'relation_teman')->
            where('is_verified',1)->where('preferensi', $preferensi)->where('name', 'like', "%".$keyword."%");    
        
        if ($request->jenis_kelamin != null) {
            $user->where('jenis_kelamin', $request->input('jenis_kelamin'));
        }

        if ($request->id_fakultas != null) {
            $user->where('id_fakultas', $request->input('id_fakultas'));
        }

        if ($request->id_program_studi != null) {
            $user->where('id_program_studi', $request->input('id_program_studi'));
        }

        if ($request->id_keminatan != null){
            $user->where('id_keminatan', $request->input('id_keminatan'));
        }

        if ($request->tahun_mulai != null) {
            $user->where('tahun_mulai', $request->input('tahun_mulai'));
        }

        if ($request->id_skillhobi != null) {
            $all = collect();
            foreach ($user->get() as $one_user) {
                if(RelationSkillhobi::where('id_mahasiswa', $one_user->id)->where('id_skillhobi', $request->input('id_skillhobi'))->first() != null){
                    $all->add($one_user);
                }
            }
            return response()->json(
                ['mahasiswa' => $all]
            );
        }

        return response()->json(
            ['mahasiswa' => $user->get()]
        );

        }

        public function searchTempatPkl(request $request){
            $keyword = $request->keyword;
            $tempat_pkl = TempatPkl::where('nama_perusahaan', 'like', "%".$keyword."%");    
                
            $all = collect();

            $searchHistory = new SearchHistory();
            $searchHistory->name = $request->keyword;
            $searchHistory->search_type = 2;
            $searchHistory->id_owner_history = auth()->user()->id;
            $searchHistory->save();
                
            if ($request->id_lokasi_pkl != null) {
                $tempat_pkl = $tempat_pkl->where('id_lokasi_pkl', $request->input('id_lokasi_pkl'));
            }

            if ($request->id_relation_bidang_kerja != null) {
                foreach ($tempat_pkl->get() as $one_tempat_pkl) {
                    if(RelationBidangKerja::where('id_tempat_pkl', $one_tempat_pkl->id)->where('id_bidang_kerja',
                    $request->input('id_relation_bidang_kerja'))->first() != null)
                    {
                        $all->add($one_tempat_pkl);
                    }
                }
                return response()->json(
                    ['tempat_pkl' => $all]
                );
            }

            return response()->json(
                ['tempat_pkl' => $tempat_pkl->get()]
            );

            }
    }



