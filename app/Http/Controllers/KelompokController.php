<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\request;
use App\Mahasiswa;
use App\Kelompok;
use App\RelationKelompok;
use App\RelationTeman;
use App\Fakultas;
use App\Notifikasi;
use App\PesanKelompok;
use Auth;


class KelompokController extends Controller
{
    public function __construct(){
        config()->set( 'auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showKelompok(){
        $kelompok =  RelationKelompok::with('kelompok')->where('id_mahasiswa', auth()->user()->id)->get();
        return $kelompok;
    }

    public function showKelompokNotInvitedYet($id_mahasiswa){
        $kelompok =  RelationKelompok::with('kelompok')->where('id_mahasiswa', auth()->user()->id)->get();

        $all = collect();
        foreach ($kelompok as $calon_anggota) {
            $checkExist = RelationKelompok::where('id_mahasiswa', $id_mahasiswa)->where('id_kelompok', $calon_anggota->id_kelompok)->first();
            if($checkExist == null){
                $all->add($calon_anggota);
            }
        }
        return $all;
    }

    public function inviteAnggota(request $request){
        $anggota = new RelationKelompok;
        $anggota->id_kelompok = $request->id_kelompok;
        $anggota->id_mahasiswa = $request->id_mahasiswa;
        $anggota->status = 0;
        $anggota->save();

        return response()->json(
            ['message' => "anggota sudah diinvite"]
        );
    }

    public function makeKelompok(request $request){
        $kelompok = new Kelompok;
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->jumlah_anggota = $request->jumlah_anggota;
        $kelompok->tipe_kelompok = $request->tipe_kelompok;
        $kelompok->foto_kelompok = $request->foto_kelompok;
        $kelompok->save();

        $itSelf = new RelationKelompok;
        $itSelf->id_kelompok = $kelompok->id;
        $itSelf->id_mahasiswa = auth()->user()->id;
        $itSelf->status = 1;
        $itSelf->save();

        foreach ($request->calon_anggotas as $calon_anggota) {
            $anggota = new RelationKelompok;
            $anggota->id_kelompok = $kelompok->id;
            $anggota->id_mahasiswa = $calon_anggota['id_mahasiswa'];
            $anggota->status = 0;
            $anggota->save();

            $notifikasi = new Notifikasi();
            $notifikasi->notifikasi_type = 4;
            $notifikasi->id_mahasiswa_pengirim = auth()->user()->id;
            $notifikasi->id_mahasiswa_penerima = $calon_anggota['id_mahasiswa'];
            $notifikasi->id_kelompok = $kelompok->id;
            $notifikasi->save();
            }

        return $kelompok;
    }

    public function showMahasiswaPending($id_kelompok){
        $anggotaPending = RelationKelompok::where('id_kelompok', $id_kelompok)->where('status', 0)->get();

        $all = collect();
        $mahasiswa = new Mahasiswa();
        foreach( $anggotaPending as $anggota){
            $mahasiswa = Mahasiswa::select('id', 'foto_profil', 'name')->find($anggota->id_mahasiswa);
            $fakultas = Fakultas::select('name')->find(Mahasiswa::find($anggota->id_mahasiswa)->id_fakultas);
            $mahasiswa->setAttribute('nama_fakultas', $fakultas->name);
            $all->add($mahasiswa);
        }

        return $all;
    }

    public function addFriendToKelompok(request $request){
        
        $all = collect();
        foreach ($request->calon_anggotas as $calon_anggota) {
            $anggota = new RelationKelompok;
            $anggota->id_kelompok = $request->id_kelompok;
            $anggota->id_mahasiswa = $calon_anggota['id_mahasiswa'];
            $anggota->status = 0;
            $anggota->save();

            $notifikasi = new Notifikasi();
            $notifikasi->notifikasi_type = 4;
            $notifikasi->id_mahasiswa_pengirim = auth()->user()->id;
            $notifikasi->id_mahasiswa_penerima = $calon_anggota['id_mahasiswa'];
            $notifikasi->id_kelompok = $request->id_kelompok;
            $notifikasi->save();
            $all->add($anggota);
            }

        return $all;
    }

    public function removeAnggotaKelompok(request $request){
        $relationKelompok = RelationKelompok::where('id_kelompok', $request->id_kelompok)->where('id_mahasiswa', $request->id_mahasiswa)->get();
        foreach($relationKelompok as $relation){
            $relation->delete();
        }
        
        $anggotaKelompok = RelationKelompok::where('id_kelompok', $request->id_kelompok)->where('status', 1)->get();

        $all = collect();
        $mahasiswa = new Mahasiswa();
        foreach( $anggotaKelompok as $anggota){
            $mahasiswa = Mahasiswa::select('id', 'foto_profil', 'name')->find($anggota->id_mahasiswa);
            $fakultas = Fakultas::select('name')->find(Mahasiswa::find($anggota->id_mahasiswa)->id_fakultas);
            $mahasiswa->setAttribute('nama_fakultas', $fakultas->name);
            $all->add($mahasiswa);
        }

        return $all;
    }

    public function getAnggotaKelompok($id_kelompok){
        $anggotaKelompok = RelationKelompok::where('id_kelompok', $id_kelompok)->where('status', 1)->get();

        $all = collect();
        $mahasiswa = new Mahasiswa();
        foreach( $anggotaKelompok as $anggota){
            $mahasiswa = Mahasiswa::select('id', 'foto_profil', 'name')->find($anggota->id_mahasiswa);
            $fakultas = Fakultas::select('name')->find(Mahasiswa::find($anggota->id_mahasiswa)->id_fakultas);
            $mahasiswa->setAttribute('nama_fakultas', $fakultas->name);
            $all->add($mahasiswa);
        }

        return $all;
    }

    public function showFriendNotAddedYet($id_kelompok){
        $mahasiswas = RelationTeman::with("mahasiswa")->where('id_mahasiswa_one', auth()->user()->id)->where('status', 1)->get()->pluck('mahasiswa');
        
        $mahasiswaNotAdded = collect();
        foreach($mahasiswas as $mahasiswa){
            $checkRelation = RelationKelompok::where('id_kelompok', $id_kelompok)->where('id_mahasiswa', $mahasiswa->id)->first();
            if($checkRelation==null){
                $mahasiswaNotAdded->add($mahasiswa);
            }
        }

        return $mahasiswaNotAdded;
    }

    public function confirmAnggotaKelompok(request $request){
        
        $notifikasi = new Notifikasi();
        if($request->status == 0){
            $anggota = RelationKelompok::where('id_kelompok', $request->id_kelompok)->
            where('id_mahasiswa', auth()->user()->id)->first();
            $notifikasi->notifikasi_type = 5;
            if($anggota != null){
                $anggota->delete();
            }
        }else if($request->status == 1){
            $anggota = RelationKelompok::where('id_kelompok', $request->id_kelompok)->
            where('id_mahasiswa', auth()->user()->id)->first();
            $anggota->status = 1;
            $anggota->save();
            $notifikasi->notifikasi_type = 6;
        }

        $ketuaKelompok = RelationKelompok::where('id_kelompok', $request->id_kelompok)->
            where('status', 1)->first();
        
        $notifikasiOld = Notifikasi::where('id_mahasiswa_pengirim', $ketuaKelompok->id_mahasiswa)->where('id_mahasiswa_penerima', auth()->user()->id)->
        where('id_kelompok', $request->id_kelompok)->first();
        $notifikasiOld->delete();

        $notifikasi->id_mahasiswa_pengirim = auth()->user()->id;
        $notifikasi->id_mahasiswa_penerima = $ketuaKelompok->id_mahasiswa;
        $notifikasi->id_kelompok = $request->id_kelompok;
        $notifikasi->save();

        return "Sudah terkonfimasi";
    }

    public function updateKelompokInfo(request $request){
        $kelompok = Kelompok::where('id',$request->id_kelompok)->first();
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->tipe_kelompok = $request->tipe_kelompok;
        $kelompok->foto_kelompok = $request->foto_kelompok;

        $kelompok->save();

        return "data kelompok sudah diupdate";
    }

    public function deleteAnggota(request $request){
        $mahasiswa = RelationKelompok::where('id_kelompok', $request->id_kelompok)
        ->where('id_mahasiswa', $request->id_mahasiswa)->first();
        $mahasiswa->delete();

        return "Data berhasil dihapus";
    }

    public function showPendingMember(request $request){
        $anggota = RelationKelompok::with('pendingMember')->where('id_kelompok', $request->id_kelompok)
        ->where('status', 0)->get();
        return $anggota;
    }

}