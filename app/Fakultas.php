<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Fakultas extends Model
{
    protected $table = 'fakultas';

    protected $fillable = [
        'name'
    ];

}
