<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempatPkl extends Model
{
    protected $table = 'tempat_pkl';

    protected $fillable = ['nama_perusahaan', 'bidang_kerja', 'nama_kota'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
