<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/task', [TaskController::class, 'index'])->name('task.index');
// Route::get('/forum', [ForumController::class, 'index'])->name('forum');

Route::get('/course/management', [CourseController::class, 'manage'])->name('course.management');

Route::get('/course/{CourseID}/session/{SessionID}/forum', [ForumController::class, 'showForum'])->name('forum.show');
// Define a route for the TaskController's index method
// Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

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

Route::get('/schedule', function () {
    return view('schedule'); // This will load resources/views/schedule.blade.php
})->name('schedule');

Route::prefix('/course/{CourseID}/session')->group(function () {
    Route::get('/{SessionID}', [SessionController::class, 'index'])->name('session.show');
    Route::post('/create', [SessionController::class, 'store'])->name('session.store');
    Route::put('/{SessionID}', [SessionController::class, 'update'])->name('session.update');
    Route::delete('/{SessionID}', [SessionController::class, 'delete'])->name('session.delete');
});

Route::prefix('/course/{CourseID}/session/{SessionID}/task')->group(function () {
    Route::get('/task', [TaskController::class, 'index'])->name('tasks.index');
});

// Route::get('/courses/{period}', [CourseController::class, 'getCoursesByPeriod'])->name('courses.period');
Route::view('/register', 'register')->name('register');
Route::view('/login', 'login')->name('login');

// Route::get('/schedule/{date}', [TaskController::class, 'getTasksByDate'])->name('schedule');


