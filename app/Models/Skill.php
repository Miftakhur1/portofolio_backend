<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'level',
        'persentase',
        'icon',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
