<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationTeman extends Model
{
    protected $table = 'relation_teman';

    protected $fillable = ['is_favorite', 'id_mahasiswa_one', 'id_mahasiswa_two', 'status'];
}
