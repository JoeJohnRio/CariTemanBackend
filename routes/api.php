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

//RelationTeman Controller
// Route::get('relationteman/{id}', 'RelationTemanController@showFriend')->middleware('jwt.verify');
Route::get('relationteman/favorite/pkl', 'RelationTemanController@showFavoriteFriendPkl');
Route::get('relationteman/favorite/lomba', 'RelationTemanController@showFavoriteFriendLomba');
Route::put('relationteman/favorite/toggle/{id_two}', 'RelationTemanController@toogleFavoriteFriend');
Route::post('relationteman/friend/{id_one}/add/{id_two}', 'RelationTemanController@addFriend');
Route::get('relationteman/friend/{id_two}', 'RelationTemanController@getRelationTeman');
Route::get('relationteman/showfriendnama', 'RelationTemanController@showFriendNameOnly');

//RelationTempatPkl
Route::put('relationtempatpkl/favorite/toogle/{id}', 'RelationTempatPklController@toggleFavoriteTempatPkl');
Route::get('relationtempatpkl/favorite', 'RelationTempatPklController@showFavoriteTempatPkl');

//Fakultas Controller
Route::get('fakultas', 'FakultasController@index');
Route::get('fakultas/programstudi/{id}', 'FakultasController@showProgramStudiById');
Route::get('fakultas/programstudi/keminatan/{id}', 'FakultasController@showKeminatanById');
Route::get('fakultas/showall/{id}', 'FakultasController@showFakultasProdiKeminatan');

//HistoryLihatProfilController
Route::get('history/lihatprofil/lomba', 'HistoryLihatProfilController@showHistoryLihatProfilLomba');
Route::get('history/lihatprofil/pkl', 'HistoryLihatProfilController@showHistoryLihatProfilPkl');
Route::get('history/lihatprofil/dashboard/pkl/', 'HistoryLihatProfilController@showHistoryLihatProfilDashboardPkl');
Route::get('history/lihatprofil/dashboard/lomba/', 'HistoryLihatProfilController@showHistoryLihatProfilDashboardLomba');
Route::get('history/lihatprofil/save/{id}', 'HistoryLihatProfilController@saveHistoryLihatProfil');
Route::post('history/newprofilclick/{id_mahasiswa}', 'HistoryLihatProfilController@addHistoryProfilClicked');

//HistoryLihatTempatPklController
Route::get('history/lihattempatpkl/dashboard', 'HistoryLihatTempatPklController@showHistoryLihatDashboardTempatPkl');
Route::get('history/lihattempatpkl/', 'HistoryLihatTempatPklController@showHistoryLihatTempatPkl');
Route::get('history/lihattempatpkl/save/{id}', 'HistoryLihatTempatPklController@saveHistoryLihatProfil');
Route::get('history/newtempatpklclick/{id_tempat_pkl}', 'HistoryLihatTempatPklController@addHistoryTempatPklClicked');

//TempatPkl
Route::get('tempatpkl/bidangkerja', 'TempatPklController@getBidangKerja');
Route::get('tempatpkl/lokasipkl', 'TempatPklController@getLokasiPkl');
Route::get('tempatpkl/', 'TempatPklController@getTempatPkl');

//Pengalaman
Route::get('pengalaman/lomba', 'PengalamanController@getPengalamanLomba');
Route::get('pengalaman/organisasi', 'PengalamanController@getPengalamanOrganisasi');
Route::post('pengalaman/lomba/', 'PengalamanController@savePengalamanLomba');
Route::post('pengalaman/organisasi', 'PengalamanController@savePengalamanOrganisasi');
Route::put('pengalaman/lomba/modify', 'PengalamanController@modifyPengalamanLomba');
Route::put('pengalaman/organisasi/modify', 'PengalamanController@modifyPengalamanOrganisasi');
Route::post('pengalaman/lomba/delete/{id}', 'PengalamanController@deletePengalamanLomba');
Route::post('pengalaman/organisasi/delete/{id}', 'PengalamanController@deletePengalamanOrganisasi');
Route::get('pengalaman/bothwithrekomendasi/{id}', 'PengalamanController@getPengalamanLombaDanOrganisasiDanRekomendasi');
Route::get('pengalaman/bothwithrekomendasi/itself', 'PengalamanController@getPengalamanLombaDanOrganisasiDanRekomendasiItself');
Route::get('pengalaman/both', 'PengalamanController@getPengalamanLombaDanOrganisasi');
Route::post('user/edit_pass', 'FakultasController@tugas');

//Search
Route::post('search/mahasiswa/', 'SearchController@searchMahasiswa');
Route::post('search/tempatpkl/', 'SearchController@searchTempatPkl');
Route::post('search/add/', 'SearchController@addSearchHistory');
Route::get('search/show/', 'SearchController@showSearchHistory');

//UlasanTempatPkl
Route::post('ulasantempatpkl/save', 'UlasanTempatPklController@saveUlasanTempatPkl');
Route::get('ulasantempatpkl/show', 'UlasanTempatPklController@showUlasanTempatPkl');


//Rekomendasi
Route::get('rekomendasi/show', 'RekomendasiController@showRekomendasiMahasiswa');
Route::post('rekomendasi/sethidden', 'RekomendasiController@setRekomendasiHiddenTrue');
Route::post('rekomendasi/save', 'RekomendasiController@saveRekomendasiMahasiswa');
Route::get('rekomendasi/profil/{id}', 'RekomendasiController@profilInfoOthers');
Route::get('rekomendasi/profil/itself', 'RekomendasiController@profilInfoOthersItself');

//Kelompok
Route::get('kelompok/show', 'KelompokController@showKelompok');
Route::get('kelompok/anggotakelompok/{id_kelompok}', 'KelompokController@getAnggotaKelompok');
Route::post('kelompok/invite', 'KelompokController@inviteAnggota');
Route::post('kelompok/make', 'KelompokController@makeKelompok');
Route::post('kelompok/addfriend', 'KelompokController@addFriendToKelompok');
Route::post('kelompok/pending', 'KelompokController@showPendingMember');
Route::post('kelompok/confirm', 'KelompokController@confirmAnggotaKelompok');
Route::post('kelompok/delete', 'KelompokController@deleteAnggota');
Route::post('kelompok/updateinfo', 'KelompokController@updateKelompokInfo');
Route::post('kelompok/removeanggota', 'KelompokController@removeAnggotaKelompok');
Route::get('kelompok/showfriendnotadded/{id_kelompok}', 'KelompokController@showFriendNotAddedYet');

//BidangKerja
Route::get('bidangkerja/search/{namaBidangKerja}', 'BidangKerjaController@showSearchBidangKerja');
Route::post('bidangkerja/make/{namaBidangKerja}', 'BidangKerjaController@makeBidangKerja');

//Skillhobi
Route::get('skillhobi/search/{namaSkillhobi}', 'SkillHobiController@showSearchSkillhobi');
Route::post('skillhobi/make/{namaSkillhobi}', 'SkillHobiController@makeSkillhobi');

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
