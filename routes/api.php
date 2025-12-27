<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Public\Controller\CourseController as ControllerCourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('courses')->group(function () {
    Route::get('', [CourseController::class, 'index']);
    Route::get('/status', [CourseController::class, 'getActiveAndInactives']);
    Route::get('{course_id}', [CourseController::class, 'show']);
    Route::post('', [CourseController::class, 'store']);
});

Route::prefix('lessons')->group(function () {
    Route::get('', [LessonController::class, 'index']);
    Route::get('/{lesson_id}', [LessonController::class, 'show']);
    Route::post('', [LessonController::class, 'store']);
});

Route::prefix('public')->group(function () {
    Route::get('/', [ControllerCourseController::class, 'index']);
    // Route::get('/{course_id}/lessons', [LessonController::class, 'getLessonsByCourse']);
});
