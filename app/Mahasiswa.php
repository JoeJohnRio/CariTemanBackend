<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Mahasiswa extends Authenticatable implements JWTSubject
{
    use notifiable;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'is_verified', 'password', 'name', 'email', 'foto_ktm', 'foto_profil', 'nim', 'tahun_mulai', 'preferensi', 
    'id_fakultas', 'id_program_studi', 'id_keminatan', 'jenis_kelamin'
    ];

    protected $hidden = [
        'password'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }
    
    public function count_rekomendasi()
    {
        return $this->hasMany('App\Rekomendasi', 'id_penerima');
    }

    public function relation_teman()
    {
        return $this->hasOne('App\RelationTeman', 'id_mahasiswa_two');
    }

    public function pengalaman_lomba()
    {
        return $this->hasOne('App\PengalamanLomba', 'id_mahasiswa');
    }

    public function pengalaman_organisasi()
    {
        return $this->hasOne('App\PengalamanOrganisasi', 'id_mahasiswa');
    }
}
