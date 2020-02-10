<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationKelompok extends Model
{
    protected $table = 'relation_kelompok';

    protected $fillable = [
        'id_kelompok', 'id_mahasiswa'
    ];
}
