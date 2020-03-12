<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class PengalamanLomba extends Model
{
    protected $table = 'pengalaman_lomba';

    protected $fillable = [
        'nama_kompetisi', 'deskripsi', 'tanggal', 'id_mahasiswa', 'gambar'
    ];

    public function relation_bidang_kerja(){
        return $this->hasMany('App\RelationBidangKerja', 'id_mahasiswa', 'id_mahasiswa');
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
