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
        return $this->hasOne('App\RelationBidangKerja', 'id_pengalaman_lomba', 'id');
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
