<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student/list', [StudentController::class, 'all_student'])->name('student_list');
Route::get('/student/create', [StudentController::class, 'Student_Create'])->name('student_create');
