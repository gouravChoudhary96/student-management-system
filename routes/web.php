<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [StudentController::class, 'index'])->name('students.home');

Route::resource('students', StudentController::class);
Route::get('students-list', [StudentController::class, 'list'])->name('students.list');
