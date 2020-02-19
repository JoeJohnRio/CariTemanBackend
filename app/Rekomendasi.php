<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Rekomendasi extends Model
{
    protected $table = 'rekomendasi';

    protected $fillable = ['jumlah_rating', 'deskripsi', 'id_pengirim', 'id_penerima'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
