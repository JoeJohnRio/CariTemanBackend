<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pesan extends Model
{
    protected $table = 'pesan';

    protected $fillable = ['isi_pesan', 'id_mahasiswa_pengirim', 'id_mahasiswa_penerima'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
