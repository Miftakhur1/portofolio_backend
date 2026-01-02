<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'headline',
        'ringkasan',
        'cv_url',
        'lokasi',
    ];
}
