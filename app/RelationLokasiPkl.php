<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationLokasiPkl extends Model
{
    protected $table = 'relation_lokasi_pkl';

    protected $fillable = ['id_tempat_pkl', 'id_lokasi_pkl'];

    public function lokasi_pkl(){
        return $this->belongsTo('App\LokasiPkl', 'id_lokasi_pkl');
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
