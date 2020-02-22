<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class RelationKelompok extends Model
{
    protected $table = 'relation_kelompok';

    protected $fillable = [
        'id_kelompok', 'id_mahasiswa', 'status'
    ];

    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'id_kelompok');
    }

    public function pendingMember(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
