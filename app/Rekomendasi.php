<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Rekomendasi extends Model
{
    protected $table = 'rekomendasi';

    protected $fillable = ['jumlah_rating', 'deskripsi', 'is_hidden', 'id_pengirim', 'id_penerima'];

    public function data_pengirim(){
        return $this->belongsTo('App\Mahasiswa', 'id_pengirim')->where('preferensi', 0);
    }

    public function data_mahasiswa(){
        return $this->belongsTo('App\Mahasiswa', 'id_pengirim');
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
