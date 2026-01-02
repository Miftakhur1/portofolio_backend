<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'nama_perusahaan',
        'posisi',
        'tipe_pekerjaan',
        'tanggal_mulai',
        'tanggal_selesai',
        'masih_bekerja',
        'deskripsi',
    ];
}
