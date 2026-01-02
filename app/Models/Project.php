<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'thumbnail',
        'deskripsi_pendek',
        'deskripsi_lengkap',
        'linkdemo',
        'linkgithub',
        'prioritas',
        'status',
        'published_at',
    ];
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
