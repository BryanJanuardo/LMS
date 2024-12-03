<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/schedule/getListCourses', [ScheduleController::class, 'getListCourses'])->name('schedule.getListCourses');
Route::get('/task', [TaskController::class, 'index'])->name('task.index');

Route::get('/register', [UserController::class, 'register'])->name('register.index');
Route::post('/register', [UserController::class, 'create'])->name('register.store');

Route::get('/login', [UserController::class, 'login'])->name('login.index');
Route::post('/login', [UserController::class, 'auth'])->name('login.store');
Route::get('/tes', [ScheduleController::class, 'getListCourses'])->name('tes');
// Route::get('/forum', [ForumController::class, 'index'])->name('forum');

Route::get('/course/management', [CourseController::class, 'manage'])->name('course.management');


Route::prefix('/course')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('course.index');
    Route::get('/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('/{courseId}', [CourseController::class, 'detail'])->name('course.detail');
    Route::get('/{courseId}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/{courseId}/update', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/{courseId}/destroy', [CourseController::class, 'destroy'])->name('course.destroy');
});

Route::prefix('/course/{CourseID}/session/{SessionID}/forum')->group(function () {
    Route::get('/', [ForumController::class, 'index'])->name('forum.index');
    Route::post('/create', [ForumController::class, 'store'])->name('forum.store');

    // buat reply
    Route::prefix('/{postId}/reply')->group(function () {
        Route::post('/create', [ForumController::class, 'reply'])->name('forum.reply');
    });
});

Route::prefix('/course/{CourseID}/session')->group(function () {
    Route::get('/create', [SessionController::class, 'create'])->name('session.create');
    Route::post('/store', [SessionController::class, 'store'])->name('session.store');
    Route::get('/{SessionID}', [SessionController::class, 'index'])->name('session.show');
    Route::put('/{SessionID}', [SessionController::class, 'update'])->name('session.update');
    Route::delete('/{SessionID}', [SessionController::class, 'delete'])->name('session.delete');
});

Route::prefix('/course/{CourseID}/session/{SessionID}/task')->group(function () {
    Route::get('/task', [TaskController::class, 'index'])->name('tasks.index');

});

// Route::get('/courses/{period}', [CourseController::class, 'getCoursesByPeriod'])->name('courses.period');
