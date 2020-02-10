<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('mahasiswa', 'MahasiswaController@index');
// Route::post('mahasiswa','MahasiswaController@create');
// Route::put('mahasiswa/{id}','MahasiswaController@update');
Route::delete('mahasiswa/{id}','MahasiswaController@delete');
Route::get('mahasiswa/{id}', 'MahasiswaController@mahasiswaKe');

//Auth Controller
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('mahasiswa', 'MahasiswaController@mahasiswa');

//Mahasiswa Controller
Route::get('mahasiswaall', 'MahasiswaController@mahasiswaAuth')->middleware('jwt.verify');
Route::get('user', 'AuthController@getUserenticatedUser')->middleware('jwt.verify');

//Relationship Controller
Route::get('relationteman/{id}', 'RelationTemanController@showFavorite');
Route::get('relationteman/favorite/{id}', 'RelationTemanController@showFavoriteFriend');
Route::put('relationteman/favorite/{id_one}/make/{id_two}', 'RelationTemanController@toogleFavoriteFriend');
Route::post('relationteman/friend/{id_one}/add/{id_two}', 'RelationTemanController@addFriend');

//Fakultas Controller
Route::get('fakultas', 'FakultasController@index');
Route::get('fakultas/programstudi/{id}', 'FakultasController@showProgramStudiById');
Route::get('fakultas/programstudi/keminatan/{id}', 'FakultasController@showKeminatanById');