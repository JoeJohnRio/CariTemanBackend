<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\Request;
use App\PesanKelompok;
use App\Pesan;
use \stdClass;
use App\Mahasiswa;

class ChatController extends Controller
{
	
    public function __construct()
    {
        config()->set('auth.defaults.guard', 'mahasiswa');
        $this->middleware('jwt.verify');
	}
	
	public function sendMessageKelompok(Request $request) {
		$pesanKelompok = new PesanKelompok();
		$pesanKelompok->isi_pesan = $request->isi_pesan;
		$pesanKelompok->id_mahasiswa_pengirim = auth()->user()->id;
		$pesanKelompok->id_kelompok = $request->id_kelompok;
		$pesanKelompok->save();

		return response()->json(
			['message' => "pesan terkirim"]
		);
	}

	public function showMessageKelompok(Request $request) {
		$pesanKelompok = PesanKelompok::where('id_kelompok', $request->id_kelompok)->orderBy('created_at','asc')->get();

		$all = collect();

		foreach($pesanKelompok as $pesan){
			$x = new stdClass();
			$x->id = $pesan->id;
			$x->isi_pesan = $pesan->isi_pesan;
			if($pesan->id_mahasiswa_pengirim == auth()->user()->id){
				$x->isPengirim = 1;
			}else{
				$x->isPengirim = 0;
			}
			$x->mahasiswa = Mahasiswa::find($pesan->id_mahasiswa_pengirim);
			$all->add($x);
		}

		return $all;
	}

	public function sendMessageUser(Request $request) {
		$pesanKelompok = new Pesan();
		$pesanKelompok->isi_pesan = $request->isi_pesan;
		$pesanKelompok->id_mahasiswa_pengirim = auth()->user()->id;
		$pesanKelompok->id_mahasiswa_penerima = $request->id_mahasiswa_penerima;
		$pesanKelompok->save();

		return response()->json(
			['message' => "pesan terkirim"]
		);
	}

	public function showMessageUser(Request $request) {
		$pesanUser = collect();
		$first = Pesan::where('id_mahasiswa_pengirim', $request->id_mahasiswa_pengirim)->where('id_mahasiswa_penerima', auth()->user()->id)->
		orderBy('created_at','asc')->get();
		$second = Pesan::where('id_mahasiswa_pengirim', auth()->user()->id)->where('id_mahasiswa_penerima', $request->id_mahasiswa_pengirim)->
		orderBy('created_at','asc')->get();

		// $pesanUser->add($first);
		// return $pesanUser;
		$all = collect();

		foreach($first as $pesan){
			$x = new stdClass();
			$x->id = $pesan->id;
			$x->isi_pesan = $pesan->isi_pesan;
			$x->isPengirim = 0;
			$x->mahasiswa = Mahasiswa::find($pesan->id_mahasiswa_pengirim);
			$all->add($x);
		}

		foreach($second as $pesan){
			$x = new stdClass();
			$x->id = $pesan->id;
			$x->isi_pesan = $pesan->isi_pesan;
			$x->isPengirim = 1;
			$x->mahasiswa = Mahasiswa::find($pesan->id_mahasiswa_penerima);
			$all->add($x);
		}
		$sorted = $all->sortBy('id');

		return $sorted->values()->all();
	}

	public function join(Request $request) {
		$this->validate($request, [
			'name' => 'required'
		]);

		$input = $request->all();
		$input['pesan'] = "now()";
		$input['waktu_terkirim'] = now();
		$input['id_mahasiswa_pengirim'] = 1;
		$input['id_mahasiswa_penerima'] = 2;

		$chat = Pesan::create($input);
		return response(['data' => $chat], 200);
	}
}
