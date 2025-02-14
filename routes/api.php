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
Route::post('mahasiswa/checkexist', 'MahasiswaController@checkIfUserExist');

//RelationTeman Controller
// Route::get('relationteman/{id}', 'RelationTemanController@showFriend')->middleware('jwt.verify');
Route::get('relationteman/favorite/pkl', 'RelationTemanController@showFavoriteFriendPkl');
Route::get('relationteman/favorite/lomba', 'RelationTemanController@showFavoriteFriendLomba');
Route::put('relationteman/favorite/toggle/{id_two}', 'RelationTemanController@toogleFavoriteFriend');
Route::post('relationteman/addfriend', 'RelationTemanController@addFriend');
Route::post('relationteman/confirm', 'RelationTemanController@confirmFriend');
Route::get('relationteman/friend/{id_two}', 'RelationTemanController@getRelationTeman');
Route::get('relationteman/showfriendnama', 'RelationTemanController@showFriendNameOnly');

//Notifikasi
Route::get('notifikasi/show', 'NotifikasiController@showNotifikasi');

//RelationTempatPkl
Route::put('relationtempatpkl/favorite/toogle/{id}', 'RelationTempatPklController@toggleFavoriteTempatPkl');
Route::get('relationtempatpkl/favorite', 'RelationTempatPklController@showFavoriteTempatPkl');

//Fakultas Controller
Route::get('fakultas', 'FakultasController@index');
Route::get('lokasipkl', 'FakultasController@showKota');
Route::get('fakultas/programstudi/{id}', 'FakultasController@showProgramStudiById');
Route::get('fakultas/programstudi/keminatan/{id}', 'FakultasController@showKeminatanById');
Route::get('fakultas/showall/{id}', 'FakultasController@showFakultasProdiKeminatan');

//HistoryLihatProfilController
Route::get('history/lihatprofil/lomba', 'HistoryLihatProfilController@showHistoryLihatProfilLomba');
Route::get('history/lihatprofil/pkl', 'HistoryLihatProfilController@showHistoryLihatProfilPkl');
Route::get('history/lihatprofil/dashboard/pkl/', 'HistoryLihatProfilController@showHistoryLihatProfilDashboardPkl');
Route::get('history/lihatprofil/dashboard/lomba/', 'HistoryLihatProfilController@showHistoryLihatProfilDashboardLomba');
Route::post('history/lihatprofil/save/{id}', 'HistoryLihatProfilController@saveHistoryLihatProfil');
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
Route::get('tempatpkl/profile/{id}', 'TempatPklController@showTempatPklProfile');
Route::post('tempatpkl/add', 'TempatPklController@addTempatPkl');

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
Route::post('pengalaman/bothwithrekomendasi/itself', 'PengalamanController@getPengalamanLombaDanOrganisasiDanRekomendasiItself');
Route::get('pengalaman/both', 'PengalamanController@getPengalamanLombaDanOrganisasi');
Route::post('user/edit_pass', 'FakultasController@tugas');

//Search
Route::post('search/mahasiswa/', 'SearchController@searchMahasiswa');
Route::post('search/tempatpkl/', 'SearchController@searchTempatPkl');
Route::post('search/add/', 'SearchController@addSearchHistory');
Route::get('search/show/', 'SearchController@showSearchHistory');

//UlasanTempatPkl
Route::post('ulasantempatpkl/save', 'UlasanTempatPklController@saveUlasanTempatPkl');
Route::get('ulasantempatpkl/show/{id}', 'UlasanTempatPklController@showUlasanTempatPkl');


//Rekomendasi
Route::get('rekomendasi/show', 'RekomendasiController@showRekomendasiMahasiswa');
Route::post('rekomendasi/sethidden', 'RekomendasiController@setRekomendasiHiddenTrue');
Route::post('rekomendasi/save', 'RekomendasiController@saveRekomendasiMahasiswa');
Route::get('rekomendasi/profil/{id}', 'RekomendasiController@profilInfoOthers');
Route::post('rekomendasi/profil/itself', 'RekomendasiController@profilInfoOthersItself');
Route::post('rekomendasi/home', 'RekomendasiController@showHomeRecommendation');

//Kelompok
Route::get('kelompok/show', 'KelompokController@showKelompok');
Route::get('kelompok/show/notinvitedyet/{id_mahasiswa}', 'KelompokController@showKelompokNotInvitedYet');
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
Route::get('kelompok/showpending/{id_kelompok}', 'KelompokController@showMahasiswaPending');


//BidangKerja
Route::get('bidangkerja/search/{namaBidangKerja}', 'BidangKerjaController@showSearchBidangKerja');
Route::post('bidangkerja/make/{namaBidangKerja}', 'BidangKerjaController@makeBidangKerja');
Route::post('mahasiswa/changeprofilpicture', 'BidangKerjaController@changeProfilePicture');

//Skillhobi
Route::get('skillhobi/search/{namaSkillhobi}', 'SkillHobiController@showSearchSkillhobi');
Route::post('skillhobi/make/{namaSkillhobi}', 'SkillHobiController@makeSkillhobi');

//Chat
Route::post('pesankelompok/send', 'ChatController@sendMessageKelompok');
Route::post('pesankelompok/show', 'ChatController@showMessageKelompok');
Route::post('pesanuser/send', 'ChatController@sendMessageUser');
Route::post('pesanuser/show', 'ChatController@showMessageUser');
Route::post('chat/', 'ChatController@store')->name('chat.store');;
Route::post('chat/join', 'ChatController@join')->name('chat.join');;

//Admin
Route::post('admin/login', 'Admin\AuthController@login');
Route::post('admin/register', 'Admin\AuthController@register');
Route::get('admin/test', 'Admin\AuthController@test');
Route::post('admin/mahasiswa', 'AdminController@mahasiswaNeedVerification');
Route::post('admin/mahasiswa/detail', 'AdminController@mahasiswaNeedVerificationDetail');
Route::post('admin/mahasiswa/confirm', 'AdminController@confirmVerificationMahasiswa');


//List API
//Login
//Register
//Logout

//History terakhir dilihat
