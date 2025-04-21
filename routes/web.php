<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CrController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\SubjectFeedbackController;
use App\Http\Controllers\AdminController;
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

    Route::get('/my-subjects', [SubjectController::class, 'mySubjects'])->name('teachersubjects');
});
Route::controller(CrController::class)->group(function () {
    Route::get('/cr', 'index')->name('cr');
    Route::post('/cr', 'store')->name('cr.store');
});

// Add CR Dashboard Route
Route::middleware(['web', 'auth:cr'])->group(function () {
    Route::get('/cr/dashboard', [CrController::class, 'dashboard'])->name('cr.dashboard');
    
    // Attendance Routes
    Route::get('/cr/attendance', [TeacherAttendanceController::class, 'index'])->name('cr.attendance.index');
    Route::get('/cr/attendance/create', [TeacherAttendanceController::class, 'create'])->name('cr.attendance.create');
    Route::post('/cr/attendance', [TeacherAttendanceController::class, 'store'])->name('cr.attendance.store');
    Route::get('/cr/attendance/{attendance}', [TeacherAttendanceController::class, 'show'])->name('cr.attendance.show');
    Route::get('/cr/attendance/{attendance}/edit', [TeacherAttendanceController::class, 'edit'])->name('cr.attendance.edit');
    Route::put('/cr/attendance/{attendance}', [TeacherAttendanceController::class, 'update'])->name('cr.attendance.update');
    Route::delete('/cr/attendance/{attendance}', [TeacherAttendanceController::class, 'destroy'])->name('cr.attendance.destroy');
    
    // Feedback Routes
    Route::get('/cr/feedback', [SubjectFeedbackController::class, 'index'])->name('cr.feedback.index');
    Route::get('/cr/feedback/create', [SubjectFeedbackController::class, 'create'])->name('cr.feedback.create');
    Route::post('/cr/feedback', [SubjectFeedbackController::class, 'store'])->name('cr.feedback.store');
    Route::get('/cr/feedback/{feedback}', [SubjectFeedbackController::class, 'show'])->name('cr.feedback.show');
    Route::get('/cr/feedback/{feedback}/edit', [SubjectFeedbackController::class, 'edit'])->name('cr.feedback.edit');
    Route::put('/cr/feedback/{feedback}', [SubjectFeedbackController::class, 'update'])->name('cr.feedback.update');
    Route::delete('/cr/feedback/{feedback}', [SubjectFeedbackController::class, 'destroy'])->name('cr.feedback.destroy');
});

Route::controller(ApplicationController::class)->group(function () {
    Route::get('/applications', 'index')->name('applications');
    Route::get('/Assign-Subjects','AssignSubjects')->name('AssignSubjects');

});
Route::controller(SubjectController::class)->group(function () {
    Route::get('/Subject', 'index')->name('subject');
    Route::post('/Subject', 'store')->name('subject.store');
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

// Timetable Management System Routes
Route::middleware(['auth'])->group(function () {
    // Department routes
    Route::resource('departments', DepartmentController::class);
    
    // Semester routes
    Route::resource('semesters', SemesterController::class);
    Route::get('/semesters/create-bulk', [SemesterController::class, 'createBulk'])->name('semesters.create-bulk');
    Route::post('/semesters/store-bulk', [SemesterController::class, 'storeBulk'])->name('semesters.store-bulk');
    
    // Timetable routes
    Route::get('/timetables', [TimetableController::class, 'index'])->name('timetables.index');
    Route::get('/timetables/semester/{semester}', [TimetableController::class, 'semesterTimetable'])->name('timetables.semester');
    Route::get('/timetables/create/{semester}', [TimetableController::class, 'create'])->name('timetables.create');
    Route::post('/timetables', [TimetableController::class, 'store'])->name('timetables.store');
    Route::get('/timetables/{timetable}', [TimetableController::class, 'show'])->name('timetables.show');
    Route::get('/timetables/{timetable}/edit', [TimetableController::class, 'edit'])->name('timetables.edit');
    Route::put('/timetables/{timetable}', [TimetableController::class, 'update'])->name('timetables.update');
    Route::delete('/timetables/{timetable}', [TimetableController::class, 'destroy'])->name('timetables.destroy');
});

// Teacher Routes
Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/attendance', [TeacherAttendanceController::class, 'teacherAttendance'])->name('teacher.attendance.index');
});

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Attendance Routes
    Route::get('/admin/attendance', [TeacherAttendanceController::class, 'adminIndex'])->name('admin.attendance.index');
    
    // Feedback Routes
    Route::get('/admin/feedback', [SubjectFeedbackController::class, 'adminIndex'])->name('admin.feedback.index');
});

require __DIR__.'/auth.php';
