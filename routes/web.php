<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'Laravel API OK';
});

// use App\Http\Controllers\Api\ProjectController;
// use App\Http\Controllers\Api\ExperienceController;
// use App\Http\Controllers\Api\SkillControlller;
// use App\Http\Controllers\Api\ContactMessageController;
// Route::get('/projects', [ProjectController::class, 'index']);
// Route::get('/experiences', [ExperienceController::class, 'index']);
// Route::get('/skills', [App\Http\Controllers\Api\SkillControlller::class, 'index']);


// Route::GET('/contacts', [ContactMessageController::class, 'store'])
//     ->middleware('throttle:5,1');