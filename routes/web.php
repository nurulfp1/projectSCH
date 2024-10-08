<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ExtracurricularController;

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
    return view('home');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/students', [StudentController::class, 'index'])->middleware('auth'); // index untuk menampilkan semua

Route::get('/student/{id}', [StudentController::class, 'show'])->middleware(['auth', 
'must-admin-or-teacher']); // untuk menampilkan detail yang sudah dibuat

Route::get('/student-add', [StudentController::class, 'create'])->middleware(['auth', 
'must-admin-or-teacher']);
Route::post('/student', [StudentController::class, 'store'])->middleware(['auth', 
'must-admin-or-teacher']);
Route::get('/student-edit/{id}', [StudentController::class, 'edit'])->middleware(['auth', 
'must-admin-or-teacher']);
Route::put('/student/{id}', [StudentController::class, 'update'])->middleware(['auth', 
'must-admin-or-teacher']);
Route::get('/student-delete/{id}', [StudentController::class, 'delete'])->middleware(['auth', 
'must-admin']);

Route::delete('/student-destroy/{id}', [StudentController::class, 'destroy'])->middleware(['auth', 
'must-admin']);
Route::get('/student-deleted', [StudentController::class, 'deletedStudent'])->middleware(['auth', 
'must-admin']);
Route::get('/student/{id}/restore', [StudentController::class, 'restore'])->middleware(['auth', 
'must-admin']);


Route::get('/class', [ClassController::class, 'index'])->middleware('auth');
Route::get('/class-detail/{id}', [ClassController::class, 'show'])->middleware('auth');
Route::get('/class-add', [ClassController::class, 'create'])->middleware('auth');
Route::post('/clas', [ClassController::class, 'store'])->middleware('auth')->middleware('auth');
Route::get('/class-edit/{id}', [ClassController::class, 'edit'])->middleware('auth');
Route::put('/class/{id}', [ClassController::class, 'update'])->middleware('auth');

Route::get('/extracurricular', [ExtracurricularController::class, 'index'])->middleware('auth');
Route::get('/extracurricular-detail/{id}', [ExtracurricularController::class, 'show'])->middleware('auth');
Route::get('/extracurricular-add', [ExtracurricularController::class, 'create'])->middleware('auth');
Route::post('/extracurriculars', [ExtracurricularController::class, 'store'])->middleware('auth');

Route::get('/teacher', [TeacherController::class, 'index'])->middleware('auth');
Route::get('/teacher-detail/{id}', [TeacherController::class, 'show'])->middleware('auth');
Route::get('/teacher-add', [TeacherController::class, 'create'])->middleware('auth');
Route::post('/teachers', [TeacherController::class, 'store'])->middleware('auth');
Route::get('/teacher-edit/{id}', [TeacherController::class, 'edit'])->middleware('auth');
Route::put('/teacher/{id}', [TeacherController::class, 'update'])->middleware('auth');

