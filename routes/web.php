<?php

use Illuminate\Support\Facades\Route;
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
    return view('home', [
        'name' => 'nurul', 
        'role' => 'admin',
        'buah' => ['pisang', 'apel', 'jeruk', 'semangka', 'kiwi']
    ]);
});

Route::get('/students', [StudentController::class, 'index']); // index untuk menampilkan semua
Route::get('/student/{id}', [StudentController::class, 'show']); // untuk menampilkan detail yang sudah dibuat
Route::get('/student-add', [StudentController::class, 'create']);
Route::post('/student', [StudentController::class, 'store']);
Route::get('/student-edit/{id}', [StudentController::class, 'edit']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::get('/student-delete/{id}', [StudentController::class, 'delete']);
Route::delete('/student-destroy/{id}', [StudentController::class, 'destroy']);
Route::get('/student-deleted', [StudentController::class, 'deletedStudent']);
Route::get('/student/{id}/restore', [StudentController::class, 'restore']);


Route::get('/class', [ClassController::class, 'index']);
Route::get('/class-detail/{id}', [ClassController::class, 'show']);
Route::get('/class-add', [ClassController::class, 'create']);
Route::post('/clas', [ClassController::class, 'store']);
Route::get('/class-edit/{id}', [ClassController::class, 'edit']);
Route::put('/class/{id}', [ClassController::class, 'update']);

Route::get('/extracurricular', [ExtracurricularController::class, 'index']);
Route::get('/extracurricular-detail/{id}', [ExtracurricularController::class, 'show']);
Route::get('/extracurricular-add', [ExtracurricularController::class, 'create']);
Route::post('/extracurriculars', [ExtracurricularController::class, 'store']);

Route::get('/teacher', [TeacherController::class, 'index']);
Route::get('/teacher-detail/{id}', [TeacherController::class, 'show']);
Route::get('/teacher-add', [TeacherController::class, 'create']);
Route::post('/teachers', [TeacherController::class, 'store']);
Route::get('/teacher-edit/{id}', [TeacherController::class, 'edit']);
Route::put('/teacher/{id}', [TeacherController::class, 'update']);

