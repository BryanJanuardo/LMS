<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');

Route::get('/forum', [ForumController::class, 'index'])->name('forum');

Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/courseManagement', [CourseController::class, 'courseManagement'])->name('courseManagement');
Route::post('/courseCreate', [CourseController::class, 'store'])->name('courseCreate.store');
Route::get('/courseManagement/{course}/edit', [CourseController::class, 'edit'])->name('courseManagement.edit');
Route::put('/courseManagement/{course}/update', [CourseController::class, 'update'])->name('courseManagement.update');
Route::delete('/courseManagement/{course}/destroy', [CourseController::class, 'destroy'])->name('courseManagement.destroy');
Route::get('/courseCreate', [CourseController::class, 'create'])->name('courses.create');
Route::get('/courses/{period}', [CourseController::class, 'getCoursesByPeriod'])->name('courses.period');


Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/forum', [ForumController::class, 'index'])->name('forum');

Route::prefix('/course/{CourseID}/session')->group(function () {
    Route::get('/{SessionID}', [SessionController::class, 'index'])->name('session');
    Route::post('/create', [SessionController::class, 'store'])->name('session.store');
    Route::put('/{SessionID}', [SessionController::class, 'update'])->name('session.update');
    Route::delete('/{SessionID}', [SessionController::class, 'delete'])->name('session.delete');
});

Route::get('/task', [TaskController::class, 'index'])->name('tasks');
