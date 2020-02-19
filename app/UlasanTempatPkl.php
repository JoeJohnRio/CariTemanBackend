<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UlasanTempatPkl extends Model
{
    protected $table = 'ulasan_tempat_pkl';

    protected $fillable = ['ulasan', 'id_tempat_pkl', 'id_pengirim'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
