<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationSkillhobi extends Model
{
    protected $table = 'relation_skillhobi';

    protected $fillable = ['id_mahasiswa', 'id_skillhobi'];

    public function skill_hobi(){
        return $this->belongsTo('App\Skillhobi', 'id_skillhobi');
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
