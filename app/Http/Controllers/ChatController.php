<?php

namespace App\Http\Controllers;

use Illuminate\Http\Controllers;
use Illuminate\Http\Request;
use App\Pesan;

class ChatController extends Controller
{
	public function store(Request $request) {
		$this->validate($request, [
			'pesan' => 'required',
			'waktu_terkirim' => 'required'
		]);

		$input = $request->all();
		$input['pesan'] = $request->pesan;
		$input['waktu_terkirim'] = now();
		$input['id_mahasiswa_pengirim'] = 1;
		$input['id_mahasiswa_penerima'] = 2;

		$chat = Pesan::create($input);
		return response(['data' => $chat], 200);
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
