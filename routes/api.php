<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\OptinoptoutController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('courses', CourseController::class);
Route::resource('students', StudentController::class);
Route::resource('training_schedules', TrainingScheduleController::class);
Route::resource('student_time', OptinoptoutController::class);

