<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiPkl extends Model
{
    protected $table = 'lokasi_pkl';

    protected $fillable = ['nama_kota'];
}
