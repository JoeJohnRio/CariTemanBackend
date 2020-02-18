<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengalamanLomba extends Model
{
    protected $table = 'pengalaman_lomba';

    protected $fillable = [
        'nama_kompetisi', 'deskripsi', 'tanggal', 'id_mahasiswa', 'id_jabatan'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
