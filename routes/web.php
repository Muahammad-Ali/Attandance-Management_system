<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::get('/login', function () {
    return redirect('/login');
});

Route::controller(homeController::class)->group(function () {
    Route::get('/', 'index')->name('homescreen');
    Route::get('/attendance-today', 'attendanceToday')->name('attendance.today');
});
Route::controller(feedbackController::class)->group(function () {
    Route::get('/feedbacks', 'index')->name('feedback');

});
Route::controller(ApplicationController::class)->group(function () {
    Route::get('/applications', 'index')->name('applications');

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
