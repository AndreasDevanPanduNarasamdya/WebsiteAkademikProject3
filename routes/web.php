<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Student routes
    Route::middleware('role:student')->group(function () {
        Route::get('/student/courses', [StudentController::class, 'courses'])->name('student.courses');
        Route::post('/student/enroll/{course}', [StudentController::class, 'enroll'])->name('student.enroll');
    });
    
    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('admin/courses', CourseController::class);
        Route::resource('admin/users', AdminController::class);
    });
});