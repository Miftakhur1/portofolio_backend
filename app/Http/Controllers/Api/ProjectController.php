<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(
            Project::where('status', 'published')
                ->whereNotNull('published_at')
                ->orderByDesc('prioritas')
                ->get([
                    'id',
                    'nama',
                    'slug',
                    'thumbnail',
                    'deskripsi_pendek',
                    'linkdemo',
                    'linkgithub',
                ])
        );
    }
}
