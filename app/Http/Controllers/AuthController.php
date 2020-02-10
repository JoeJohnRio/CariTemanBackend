<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct(){
        config()->set( 'auth.defaults.guard', 'mahasiswa');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
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
            'foto_ktm' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'foto_ktm' => $request->file('foto_ktm'),
            // 'foto_ktm' => 'SSSSS',
            'preferensi' => $request->get('preferensi'),
            'tahun_mulai' => $request->get('tahun_mulai')
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

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