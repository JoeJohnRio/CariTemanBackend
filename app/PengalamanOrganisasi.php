<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class PengalamanOrganisasi extends Model
{
    protected $table = 'pengalaman_organisasi';

    protected $fillable = ['nama_organisasi', 'deskripsi', 
    'tanggal_mulai', 'tanggal_selesai', 'id_mahasiswa', 'id_bidang_kerja', 'gambar'];

    public function relation_bidang_kerja()
    {
        return $this->hasOne('App\RelationBidangKerja', 'id_mahasiswa');
    }

    public function bidang_kerja(){
        return $this->belongsTo('App\BidangKerja', 'id_bidang_kerja');
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
