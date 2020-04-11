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

//MahasiswaStarterPack
Route::get('mahasiswa', 'MahasiswaController@index');
// Route::post('mahasiswa','MahasiswaController@create');
// Route::put('mahasiswa/{id}','MahasiswaController@update');
Route::delete('mahasiswa/{id}','MahasiswaController@delete');
Route::get('mahasiswa/{id}', 'MahasiswaController@mahasiswaKe');

//Auth Controller
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('cekakun', 'AuthController@cekAkun');
// Route::get('mahasiswa', 'MahasiswaController@mahasiswa');
Route::get('test', 'AuthController@test');

//Mahasiswa Controller
Route::get('mahasiswaall', 'MahasiswaController@mahasiswaAuth')->middleware('jwt.verify');
Route::get('user', 'AuthController@getUserenticatedUser')->middleware('jwt.verify');

//Relationship Controller
Route::get('relationteman/{id}', 'RelationTemanController@showFriend')->middleware('jwt.verify');
Route::get('relationteman/favorite/{id}', 'RelationTemanController@showFavoriteFriend');
Route::put('relationteman/favorite/toggle/{id_two}', 'RelationTemanController@toogleFavoriteFriend');
Route::post('relationteman/friend/{id_one}/add/{id_two}', 'RelationTemanController@addFriend');

//RelationTempatPkl
Route::post('relationtempatpkl/favorite/toogle/{id}', 'RelationTempatPklController@toggleFavoriteTempatPkl');
Route::get('relationtempatpkl/favorite', 'RelationTempatPklController@showFavoriteTempatPkl');


//Fakultas Controller
Route::get('fakultas', 'FakultasController@index');
Route::get('fakultas/programstudi/{id}', 'FakultasController@showProgramStudiById');
Route::get('fakultas/programstudi/keminatan/{id}', 'FakultasController@showKeminatanById');

//HistoryLihatProfilController
Route::get('history/lihatprofil/lomba', 'HistoryLihatProfilController@showHistoryLihatProfilLomba');
Route::get('history/lihatprofil/pkl', 'HistoryLihatProfilController@showHistoryLihatProfilPkl');
Route::get('history/lihatprofil/dashboard/pkl/', 'HistoryLihatProfilController@showHistoryLihatProfilDashboardPkl');
Route::get('history/lihatprofil/dashboard/lomba/', 'HistoryLihatProfilController@showHistoryLihatProfilDashboardLomba');
Route::get('history/lihatprofil/save/{id}', 'HistoryLihatProfilController@saveHistoryLihatProfil');

//HistoryLihatTempatPklController
Route::get('history/lihattempatpkl/dashboard', 'HistoryLihatTempatPklController@showHistoryLihatDashboardTempatPkl');
Route::get('history/lihattempatpkl/', 'HistoryLihatTempatPklController@showHistoryLihatTempatPkl');
Route::get('history/lihattempatpkl/save/{id}', 'HistoryLihatTempatPklController@saveHistoryLihatProfil');

//TempatPkl
Route::get('tempatpkl/bidangkerja', 'TempatPklController@getBidangKerja');
Route::get('tempatpkl/lokasipkl', 'TempatPklController@getLokasiPkl');
Route::get('tempatpkl/', 'TempatPklController@getTempatPkl');

//Pengalaman
Route::get('pengalaman/lomba', 'PengalamanController@getPengalamanLomba');
Route::post('pengalaman/lomba/', 'PengalamanController@savePengalamanLomba');
Route::put('pengalaman/lomba/{id}', 'PengalamanController@modifyPengalamanLomba');
Route::get('pengalaman/organisasi', 'PengalamanController@getPengalamanOrganisasi');
Route::post('pengalaman/organisasi', 'PengalamanController@savePengalamanOrganisasi');
Route::put('pengalaman/organisasi/{id}', 'PengalamanController@modifyPengalamanOrganisasi');

//Search
Route::post('search/mahasiswa/pkl', 'SearchController@searchMahasiswa');

//UlasanTempatPkl
Route::post('ulasantempatpkl/save', 'UlasanTempatPklController@saveUlasanTempatPkl');
Route::get('ulasantempatpkl/show', 'UlasanTempatPklController@showUlasanTempatPkl');


//Rekomendasi
Route::get('rekomendasi/show', 'RekomendasiController@showRekomendasiMahasiswa');
Route::post('rekomendasi/sethidden', 'RekomendasiController@setRekomendasiHiddenTrue');
Route::post('rekomendasi/save', 'RekomendasiController@saveRekomendasiMahasiswa');
Route::get('rekomendasi/count', 'RekomendasiController@countBanyakRekomendasi');

//Kelompok
Route::get('kelompok/show', 'KelompokController@showKelompok');
Route::post('kelompok/invite', 'KelompokController@inviteAnggota');
Route::post('kelompok/make', 'KelompokController@makeKelompok');
Route::post('kelompok/pending', 'KelompokController@showPendingMember');
Route::post('kelompok/confirm', 'KelompokController@confirmAnggotaKelompok');
Route::post('kelompok/delete', 'KelompokController@deleteAnggota');
Route::post('kelompok/updateinfo', 'KelompokController@updateKelompokInfo');

//Chat
Route::post('chat/', 'ChatController@store')->name('chat.store');;
Route::post('chat/join', 'ChatController@join')->name('chat.join');;

Route::post('admin/login', 'Admin\AuthController@login');
Route::post('admin/register', 'Admin\AuthController@register');
Route::get('admin/test', 'Admin\AuthController@test');


//List API
//Login
//Register
//Logout

//History terakhir dilihat
