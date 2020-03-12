<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class HistoryLihatProfil extends Model
{
    protected $table = 'history_lihat_profil';

    protected $fillable = ['id_mahasiswa_one', 'id_mahasiswa_two', 'created_at'];

    public function mahasiswa_two_pkl(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa_two')->where('preferensi', 0);
    }

    public function mahasiswa_two_lomba(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa_two')->where('preferensi', 1);
    }
    
    public function tempat_pkl(){
        return $this->belongsTo('App\TempatPkl', 'tempat_pkl');
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

