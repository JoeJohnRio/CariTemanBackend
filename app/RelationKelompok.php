<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class RelationKelompok extends Model
{
    protected $table = 'relation_kelompok';

    protected $fillable = [
        'id_kelompok', 'id_mahasiswa'
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
