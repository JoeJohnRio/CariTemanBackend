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
    'id_fakultas', 'id_program_studi', 'id_keminatan'
    ];

    protected $hidden = [
        'password'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
