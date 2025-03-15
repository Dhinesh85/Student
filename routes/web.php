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






