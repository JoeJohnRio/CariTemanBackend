<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengalamanOrganisasi extends Model
{
    protected $table = 'pengalaman_organisasi';

    protected $fillable = ['nama_organisasi', 'deskripsi', 
    'tanggal_mulai', 'tanggal_selesai', 'id_mahasiswa', 'id_jabatan'];
}
