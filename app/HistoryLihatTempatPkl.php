<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class HistoryLihatTempatPkl extends Model
{
    protected $table = 'history_lihat_tempat_pkl';

    protected $fillable = ['id_mahasiswa', 'id_tempat_pkl', 'created_at'];

    public function tempat_pkl(){
        return $this->belongsTo('App\TempatPkl', 'id_tempat_pkl');
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
