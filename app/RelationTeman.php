<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class RelationTeman extends Model
{
    protected $table = 'relation_teman';

    protected $fillable = ['is_favorite', 'id_mahasiswa_one', 'id_mahasiswa_two', 'status'];

    public function mahasiswa_two_pkl(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa_two')->where('preferensi', 0);
    }

    public function mahasiswa_two_lomba(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa_two')->where('preferensi', 1);
    }

    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa_two')->select('id', 'name');
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
