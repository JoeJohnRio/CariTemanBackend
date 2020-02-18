<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompok';

    protected $fillable = [
        'jumlah_kelompok', 'tipe_kelompok', 'nama_kelompok'
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
