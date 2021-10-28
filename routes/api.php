<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController, ModuleController, LessonController
};

Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{identify}', [CourseController::class, 'destroy']);
Route::get('/courses/{identify}', [CourseController::class, 'show']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses', [CourseController::class, 'index']);

Route::apiResource('/courses/{course}/modules', ModuleController::class);

Route::apiResource('/modules/{module}/lessons', LessonController::class);
