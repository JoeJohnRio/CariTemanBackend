<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class PengalamanOrganisasi extends Model
{
    protected $table = 'pengalaman_organisasi';

    protected $fillable = ['nama_organisasi', 'deskripsi', 
    'tanggal_mulai', 'tanggal_selesai', 'id_mahasiswa', 'gambar'];

    public function relation_bidang_kerja()
    {
        return $this->hasOne('App\RelationBidangKerja', 'id_pengalaman_organisasi', 'id');
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
