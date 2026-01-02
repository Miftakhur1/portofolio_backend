<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillControlller extends Controller
{
    public function index()
    {
        return response()->json(
            Skill::all()
        );
    }
}
