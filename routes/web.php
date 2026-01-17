<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;

//ログイン関連
Route::get('/login', [AuthController::class, 'showLogin'])->name('showlogin');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('showregister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout']);

// メニュー（students/menu）
Route::get('/menu', [StudentController::class, 'menu'])->name('menu');
Route::post('/upgrade', [StudentController::class, 'upgrade'])->name('upgrade');

//成績編集・追加
Route::get('/students/{student}/grades/edit', [GradeController::class, 'edit'])->name('grades.edit');
Route::put('/students/{student}/grades', [GradeController::class, 'update'])->name('grades.update');
Route::get('/students/{student}/grades/add', [GradeController::class, 'add'])->name('grades.add');
Route::post('/students/{student}/grades', [GradeController::class, 'store'])->name('grades.store');
Route::delete('/students/{student}/grades', [GradeController::class, 'destroy'])->name('grades.destroy');

//学生編集
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');

//学生(CRUD 7ルート)
Route::resource('students', StudentController::class);
