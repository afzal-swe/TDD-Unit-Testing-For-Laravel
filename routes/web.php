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
Route::post('/student/store', [StudentController::class, 'Student_Store'])->name('student.store');
Route::get('/student/edit/{id}', [StudentController::class, 'Student_Edit'])->name('student.edit');
Route::put('/student/update/{id}', [StudentController::class, 'Student_Update'])->name('student.update');
Route::delete('/student/delete/{id}', [StudentController::class, 'Student_Delete'])->name('student.delete');
