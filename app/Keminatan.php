<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keminatan extends Model
{
    protected $table = 'keminatan';

    protected $fillable = [
        'name', 'id_program_studi'
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
