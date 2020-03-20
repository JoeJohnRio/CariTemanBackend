<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class TempatPkl extends Model
{
    protected $table = 'tempat_pkl';

    protected $fillable = ['nama_perusahaan', 'gambar', 'id_bidang_kerja', 'id_lokasi_pkl'];
    
    public function lokasi_pkl(){
        return $this->belongsTo('App\LokasiPkl', 'id_lokasi_pkl');
    }
    
    public function bidang_kerja(){
        return $this->belongsTo('App\BidangKerja', 'id_bidang_kerja');
    }

    public function count_ulasan_tempat_pkl()
    {
        return $this->hasMany('App\UlasanTempatPkl', 'id_tempat_pkl');
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
