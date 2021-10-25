<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController
};

Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses', [CourseController::class, 'index']);
