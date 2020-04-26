<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationBidangKerja extends Model
{
    protected $table = 'relation_bidang_kerja';

    protected $fillable = ['id_mahasiswa', 'id_bidang_kerja', 'id_tempat_pkl', 'id_pengalaman_lomba',
    'id_pengalaman_organisasi'];

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
