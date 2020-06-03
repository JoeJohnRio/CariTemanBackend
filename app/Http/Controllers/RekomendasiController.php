<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekomendasi;
use App\RelationTeman;
use App\RelationKelompok;
use App\RelationBidangKerja;
use App\BidangKerja;
use App\Mahasiswa;
use App\Fakultas;
use App\ProgramStudi;
use App\Keminatan;
use App\LokasiPkl;
use App\Notifikasi;
use App\PengalamanLomba;
use App\PengalamanOrganisasi;
use App\TempatPkl;
use App\RelationLokasiPkl;
use App\UlasanTempatPkl;
use App\RelationTempatPkl;
use \stdClass;

class RekomendasiController extends Controller
{
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
    }

    public function showHomeRecommendation(request $request){
        
                //kembalikan, jumlah rekomendasi, nama, pengalaman lomba, pengalaman organisasi, gambar pengalaman
        $all = collect();
        if($request->type_of_recommendation == 1 || $request->type_of_recommendation == 2){//pkl = 1 lomba = 2
            $mahasiswas = Mahasiswa::where('id', '!=', auth()->user()->id)->where('preferensi', $request->type_of_recommendation-1)->get();
                foreach($mahasiswas as $mahasiswa){
                    $returnObject = new stdClass();
                    $returnObject->id = $mahasiswa->id;
                    $returnObject->name = $mahasiswa->name;
                    $checkIsFavorite = RelationTeman::where('id_mahasiswa_one', auth()->user()->id)->where('id_mahasiswa_two', $mahasiswa->id)->first();
                    if($checkIsFavorite != null){
                        $returnObject->is_favorite = $checkIsFavorite->is_favorite;
                    }else{
                        $returnObject->is_favorite = 0;
                    }
                    $returnObject->gambar = $mahasiswa->foto_profil;
                    $pengalaman_lombas = PengalamanLomba::where('id_mahasiswa', $mahasiswa->id)->get();
                    $all_pengalaman_lomba = collect();
                    foreach($pengalaman_lombas as $pengalaman_lomba){
                        $a = new stdClass();
                        $a->nama_kompetisi = $pengalaman_lomba->nama_kompetisi;
                        $a->gambar = $pengalaman_lomba->gambar;
                        $a->bidang_kerja_id = RelationBidangKerja::where('id_pengalaman_lomba', $pengalaman_lomba->id)->first()->id_bidang_kerja;
                        $a->bidang_kerja_nama = BidangKerja::find(RelationBidangKerja::where('id_pengalaman_lomba', $pengalaman_lomba->id)->first()->id_bidang_kerja)->nama_bidang_kerja;
                        $all_pengalaman_lomba->add($a);
                    }
                    $returnObject->pengalaman_lomba = $all_pengalaman_lomba;
                    
                    $pengalaman_organisasis = PengalamanOrganisasi::where('id_mahasiswa', $mahasiswa->id)->get();
                    $all_pengalaman_organisasi = collect();

                    foreach($pengalaman_organisasis as $pengalaman_organisasi){
                        $a = new stdClass();
                        $a->nama_organisasi = $pengalaman_organisasi->nama_organisasi;
                        $a->gambar = $pengalaman_organisasi->gambar;
                        $a->bidang_kerja_id = RelationBidangKerja::where('id_pengalaman_organisasi', $pengalaman_organisasi->id)->first()->id_bidang_kerja;
                        $a->bidang_kerja_nama = BidangKerja::find(RelationBidangKerja::where('id_pengalaman_organisasi', $pengalaman_organisasi->id)->first()->id_bidang_kerja)->nama_bidang_kerja;
                        $all_pengalaman_organisasi->add($a);
                    }

                    $returnObject->pengalaman_organisasi = $all_pengalaman_organisasi;
                    $jumlah_pengalaman = PengalamanOrganisasi::where('id_mahasiswa', $mahasiswa->id)->get()->count() +
                    PengalamanLomba::where('id_mahasiswa', $mahasiswa->id)->get()->count();
                    $jumlah_rekomendasi = Rekomendasi::where('id_penerima', $mahasiswa->id)->get()->count();
                    $jumlah_tim = RelationKelompok::where('id_mahasiswa', $mahasiswa->id)->get()->count();
                    $returnObject->jumlah_tim = RelationKelompok::where('id_mahasiswa', $mahasiswa->id)->get()->count();
                    $returnObject->jumlah_pengalaman = $jumlah_pengalaman;
                    $returnObject->type_of_recommendation = $request->type_of_recommendation;
                    $returnObject->jumlah_rekomendasi = $jumlah_rekomendasi;
                    $returnObject->recommendation_scale = $jumlah_pengalaman * 6 + $jumlah_rekomendasi * 4 + ($jumlah_tim*5*-1);

                    $all->add($returnObject);
                }
                
                $res = [];
                $test = $all->sortByDesc('recommendation_scale');
                foreach ($test  as $key => $value) {
                    $res[] = $value;
                }
                return $res;

        }else if($request->type_of_recommendation == 3){//tempat pkl
            //jumlah rekomendasi, nama, bidang kerja, dan kota
            $all = collect();

            $tempatPkls = TempatPkl::all();
            foreach($tempatPkls as $tempatPkl){
                $returnObject = new stdClass();
                $returnObject->id = $tempatPkl->id;
                $returnObject->gambar = $tempatPkl->gambar;
                $checkIsFavorite = RelationTempatPkl::where('id_mahasiswa', auth()->user()->id)->where('id_tempat_pkl', $tempatPkl->id)->first();
                    if($checkIsFavorite != null){
                        $returnObject->is_favorite = $checkIsFavorite->is_favorite;
                    }else{
                        $returnObject->is_favorite = 0;
                    }
                $returnObject->type_of_recommendation = $request->type_of_recommendation;
                $returnObject->nama_perusahaan = $tempatPkl->nama_perusahaan;
                $returnObject->jumlah_rekomendasi = UlasanTempatPkl::where('id_tempat_pkl', $tempatPkl->id)->count();
                $returnObject->id_bidang_kerja = RelationBidangKerja::where('id_tempat_pkl', $tempatPkl->id)->first()->id;
                $returnObject->nama_bidang_kerja = BidangKerja::find(RelationBidangKerja::where('id_tempat_pkl', $tempatPkl->id)->first()->id_bidang_kerja)->nama_bidang_kerja;
                $returnObject->nama_kota = LokasiPkl::find(RelationLokasiPkl::where('id_tempat_pkl', $tempatPkl->id)->first()->id_lokasi_pkl)->nama_kota;
                $all->add($returnObject);
            }

            
            $res = [];
            $test = $all->sortByDesc('jumlah_rekomendasi');
            foreach ($test  as $key => $value) {
                $res[] = $value;
            }
            return $res;
        }
    }

    public function showRekomendasiMahasiswa(){
        $history = Rekomendasi::with('data_pengirim')->where('id_penerima', auth()->user()->id)->orderBy('created_at','desc')->get();
        return $history;
    }

    public function saveRekomendasiMahasiswa(request $request){
        $rekomendasi = new Rekomendasi();
        $rekomendasi->jumlah_rating = $request->jumlah_rating;
        $rekomendasi->deskripsi = $request->deskripsi;
        $rekomendasi->id_pengirim = auth()->user()->id;
        $rekomendasi->id_penerima = $request->id_penerima;

        if(Rekomendasi::where('id_pengirim', auth()->user()->id)->where('id_penerima', $request->id_penerima)->exists()){
            return response()->json(['message' => "Sudah pernah mengisi rekomendasi"]);
        }else{
            $notifikasi = new Notifikasi();
            $notifikasi->notifikasi_type = 7;
            $notifikasi->id_mahasiswa_pengirim = auth()->user()->id;
            $notifikasi->id_mahasiswa_penerima = $request->id_penerima;
            $notifikasi->save();
            $rekomendasi->save();
            return response()->json(['message' => "Rekomendasi ditambahkan"]);
        }
    }

    public function setRekomendasiHiddenTrue(request $request){
        // $rekomendasi = new Rekomendasi();
        $rekomendasi = Rekomendasi::where('id_pengirim', $request->id_pengirim)->where('id_penerima', auth()->user()->id)->first();
        $rekomendasi->save();
    }

    public function setRekomendasiHiddenFalse(request $request){
        // $rekomendasi = new Rekomendasi();
        $rekomendasi = Rekomendasi::where('id_pengirim', $request->id_pengirim)->where('id_penerima', auth()->user()->id)->first();
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
