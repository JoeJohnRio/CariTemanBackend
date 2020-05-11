<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skillhobi extends Model
{
    protected $table = 'skillhobi';

    protected $fillable = [
        'nama_skillhobi'
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
