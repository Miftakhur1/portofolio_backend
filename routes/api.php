<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\SkillControlller;

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/experiences', [ExperienceController::class, 'index']);
Route::get('/skills', [SkillControlller::class, 'index']);
