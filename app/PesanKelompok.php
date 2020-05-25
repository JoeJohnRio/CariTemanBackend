<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesanKelompok extends Model
{
    protected $table = 'pesan_kelompok';

    protected $fillable = ['isi_pesan', 'id_mahasiswa_pengirim', 'id_kelompok'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
