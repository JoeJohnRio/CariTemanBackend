<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class TempatPkl extends Model
{
    protected $table = 'tempat_pkl';

    protected $fillable = ['nama_perusahaan', 'gambar', 'id_lokasi_pkl', 'phone_numbe'];
    
    public function lokasi_pkl(){
        return $this->belongsTo('App\LokasiPkl', 'id_lokasi_pkl');
    }
    
    public function relation_bidang_kerja(){
        return $this->hasMany('App\RelationBidangKerja', 'id_tempat_pkl');
    }

    public function count_ulasan_tempat_pkl()
    {
        return $this->hasMany('App\UlasanTempatPkl', 'id_tempat_pkl');
    }

    public function relation_tempat_pkl()
    {
        return $this->hasOne('App\RelationTempatPkl', 'id_tempat_pkl');
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
