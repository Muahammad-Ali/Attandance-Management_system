<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CrController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;




Route::get('/login', function () {
    return redirect('/login');
});
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::controller(homeController::class)->group(function () {
    Route::get('/', 'index')->name('homescreen');
    Route::get('/attendance-today', 'attendanceToday')->name('attendance.today');
});
Route::controller(feedbackController::class)->group(function () {
    Route::get('/feedbacks', 'index')->name('feedback');

});


Route::middleware(['web'])->controller(TeacherController::class)->group(function () {
    Route::get('/teacher', 'index')->name('teacher');
    Route::post('/teacher', 'store')->name('teacher.store');
    // Route::get('/teacher/dashboard', 'dashboard')->name('teacher.dashboard');
});


Route::middleware(['web', 'auth:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
});
Route::controller(CrController::class)->group(function () {
    Route::get('/cr', 'index')->name('cr');
    Route::post('/cr', 'store')->name('cr.store');
});

Route::controller(ApplicationController::class)->group(function () {
    Route::get('/applications', 'index')->name('applications');

});
Route::controller(SubjectController::class)->group(function () {
    Route::get('/Subject', 'index')->name('subject');

});


Route::controller(EmployeeController::class)->group(function () {
    Route::get('/home', 'index')->name('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');;

// Route::get('/dashboard',  function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
