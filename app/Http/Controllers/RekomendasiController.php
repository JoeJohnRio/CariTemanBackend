<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekomendasi;
use App\RelationTeman;
use App\RelationKelompok;
use App\Mahasiswa;
use App\Fakultas;
use App\ProgramStudi;
use App\Keminatan;
use App\Notifikasi;
use \stdClass;

class RekomendasiController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showRekomendasiMahasiswa(){
        $history = Rekomendasi::with('data_pengirim')->where('id_penerima', auth()->user()->id)->orderBy('created_at','desc')->get();
        return $history;
    }

    public function saveRekomendasiMahasiswa(request $request){
        $rekomendasi = new Rekomendasi();
        $rekomendasi->jumlah_rating = $request->jumlah_rating;
        $rekomendasi->deskripsi = $request->deskripsi;
        $rekomendasi->is_hidden = false;
        $rekomendasi->id_pengirim = auth()->user()->id;
        $rekomendasi->id_penerima = $request->id_penerima;


        $notifikasi = new Notifikasi();
        $notifikasi->notifikasi_type = 7;
        $notifikasi->id_mahasiswa_pengirim = auth()->user()->id;
        $notifikasi->id_mahasiswa_penerima = $request->id_penerima;
        $notifikasi->save();

        if(Rekomendasi::where('id_pengirim', auth()->user()->id)->where('id_penerima', $request->id_penerima)->exists()){
            return "Sudah pernah mengisi rekomendasi";
        }else{
            $rekomendasi->save();
            return "Rekomendasi ditambahkan";
        }
    }

    public function setRekomendasiHiddenTrue(request $request){
        // $rekomendasi = new Rekomendasi();
        $rekomendasi = Rekomendasi::where('id_pengirim', $request->id_pengirim)->where('id_penerima', auth()->user()->id)->first();
        $rekomendasi->is_hidden = true;
        $rekomendasi->save();
    }

    public function setRekomendasiHiddenFalse(request $request){
        // $rekomendasi = new Rekomendasi();
        $rekomendasi = Rekomendasi::where('id_pengirim', $request->id_pengirim)->where('id_penerima', auth()->user()->id)->first();
        $rekomendasi->is_hidden = true;
        $rekomendasi->save();
    }

    public function profilInfoOthers($id){
        $teman = Mahasiswa::where('id', $id);
        $relasiTeman = new stdClass();
        if($id == auth()->user()->id){
            $relasiTeman->status = -1;
            $relasiTeman->is_favorite = 0;
        }else{
            $relasiMeToHim = new RelationTeman();
            $relasiMeToHim = RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $id)->first();
            
            $relasiHimToMe = RelationTeman::where('id_mahasiswa_one', $id)->where('id_mahasiswa_two', auth()->user()->id)->first();
            
            if($relasiMeToHim == null && $relasiHimToMe == null){
                $relasiTeman->status = 0;
                $relasiTeman->is_favorite = 0;
            }else{
                if($relasiMeToHim != null){
                    $relasiTeman = $relasiMeToHim;
                    if($relasiTeman->status == 2){
                        $relasiTeman->status = 3;
                    }
                }else if($relasiHimToMe != null){
                    $relasiTeman = $relasiHimToMe;
                }
            }
        }

        return response()->json(
            ['name' => $teman->value('name'),
            'tahun_mulai' => $teman->value('tahun_mulai'),
            'foto_profil' => $teman->value('foto_profil'),
            'status' => $relasiTeman->status,
            'is_favorite' => $relasiTeman->is_favorite,
            'jumlah_teman' => RelationTeman::where('id_mahasiswa_one', $id)->where('status', 1)->count(),
            'jumlah_rekomendasi' => Rekomendasi::where('id_penerima', $id)->count(),
            'jumlah_kelompok' => RelationKelompok::where('id_mahasiswa', $id)->count(),
            'fakultas' => Fakultas::where('id', Mahasiswa::where('id', $id)->pluck('id_fakultas'))->value('name'),
            'program_studi' => ProgramStudi::where('id', Mahasiswa::where('id', $id)->pluck('id_program_studi'))->value('name'),
            'keminatan' => Keminatan::where('id', Mahasiswa::where('id', $id)->pluck('id_keminatan'))->value('name')
            ]
        );
    }

    public function profilInfoOthersItself(){
        $teman = Mahasiswa::where('id', auth()->user()->id);

        return response()->json(
            ['name' => $teman->value('name'),
            'tahun_mulai' => $teman->value('tahun_mulai'),
            'foto_profil' => $teman->value('foto_profil'),
            'jumlah_teman' => RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->count(),
            'jumlah_rekomendasi' => Rekomendasi::where('id_penerima', auth()->user()->id)->count(),
            'jumlah_kelompok' => RelationKelompok::where('id_mahasiswa', auth()->user()->id)->count(),
            'fakultas' => Fakultas::where('id', Mahasiswa::where('id', auth()->user()->id)->pluck('id_fakultas'))->value('name'),
            'program_studi' => ProgramStudi::where('id', Mahasiswa::where('id', auth()->user()->id)->pluck('id_program_studi'))->value('name'),
            'keminatan' => Keminatan::where('id', Mahasiswa::where('id', auth()->user()->id)->pluck('id_keminatan'))->value('name')
            ]
        );
    }
}
