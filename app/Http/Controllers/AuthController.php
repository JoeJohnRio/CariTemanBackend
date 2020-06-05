<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function cekAkun(request $request){
        if(Mahasiswa::Where('email', '=', $request->email)->first()!=null){
            return "Akun sudah terdaftar";
        }else if(Mahasiswa::Where('nim', '=', $request->nim)->first()!=null){
            return "Akun sudah terdaftar";
        }else{
            return "Akun belum terdaftar";
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials']);
            }
            $mahasiswa = Mahasiswa::Where('email', $request->email)->value('is_verified'); 
            if($mahasiswa == 0){
                return response()->json(['error' => 'belum diverifikasi']);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mahasiswa',
            'nim' => 'required|string|max:15|unique:mahasiswa',
            'password' => 'required|string|min:6|confirmed',
            'jenis_kelamin' => 'required|boolean',
            'id_fakultas' => 'required|integer',
            'id_program_studi' => 'required|integer',
            'id_keminatan' => 'integer',
            'foto_ktm' => 'required|string',
            'foto_profil' => 'required|string',
            'preferensi' => 'required|integer',
            'tahun_mulai' => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = Mahasiswa::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'nim' => $request->get('nim'),
            'password' => Hash::make($request->get('password')),
            'foto_ktm' => $request->get('foto_ktm'),
            'foto_profil' => $request->get('foto_profil'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'preferensi' => $request->get('preferensi'),
            'id_fakultas' => $request->get('id_fakultas'),
            'id_program_studi' => $request->get('id_program_studi'),
            'id_keminatan' => $request->get('id_keminatan'),
            'tahun_mulai' => $request->get('tahun_mulai'),
            'is_verified' => false
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    // public function loginAdmin(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     try {
    //         if (! $token = JWTAuth::attempt($credentials)) {
    //             return response()->json(['error' => 'invalid_credentials'], 400);
    //         }
    //     } catch (JWTException $e) {
    //         return response()->json(['error' => 'could_not_create_token'], 500);
    //     }
        
    //     return response()->json(compact('token'));
    // }

    // public function registerAdmin(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email|max:255|unique:admin',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     if($validator->fails()){
    //         return response()->json($validator->errors()->toJson(), 400);
    //     }

    //     $user = Admin::create([
    //         'email' => $request->get('email'),
    //         'password' => Hash::make($request->get('password')),
    //     ]);

    //     $token = JWTAuth::fromUser($user);

    //     return response()->json(compact('user','token'),201);
    // }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
    public function test()
    
    {
        return response()->json(auth()->user());
    }
}