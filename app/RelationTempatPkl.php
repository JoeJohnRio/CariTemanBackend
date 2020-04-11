<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationTempatPkl extends Model
{
    protected $table = 'relation_tempat_pkl';

    protected $fillable = ['is_favorite', 'id_mahasiswa', 'id_tempat_pkl'];

    public function tempat_pkl(){
        return $this->belongsTo('App\TempatPkl', 'id_tempat_pkl');
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
