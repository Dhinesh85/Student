<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\Opt;
use App\Http\Controllers\OptinoptoutController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/courses',[CourseController::class,'Index'])->name('course');
Route::get('/student',[StudentController::class,'Index'])->name('students');
Route::get('/trainingschedule',[TrainingScheduleController::class,'Index'])->name('trainingschedule');
Route::get('/opt-in-opt-out',[OptinoptoutController::class,'Index'])->name('optinoptout');




