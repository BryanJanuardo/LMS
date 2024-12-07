<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\MaterialController;
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

Route::get('/course/management', [CourseController::class, 'manage'])->name('course.management');
Route::get('/course/session', [SessionController::class, 'course'])->name('session.course');

Route::prefix('/course')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('course.index');
    Route::get('/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/store', [CourseController::class, 'store'])->name('course.store');
    Route::post('/enroll', [CourseController::class, 'enroll'])->name('course.enroll');
    Route::get('/{CourseID}', [CourseController::class, 'detail'])->name('course.detail');
    Route::get('/{CourseID}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/{CourseID}/update', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/{CourseID}/destroy', [CourseController::class, 'destroy'])->name('course.destroy');
    Route::get('{CourseID}/session/management', [SessionController::class, 'manage'])->name('session.management');


    Route::prefix('/{CourseID}/session')->group(function () {
        Route::get('/create', [SessionController::class, 'create'])->name('session.create');
        Route::post('/store', [SessionController::class, 'store'])->name('session.store');
        Route::get('/{SessionID}', [SessionController::class, 'index'])->name('session.show');
        Route::put('/{SessionID}', [SessionController::class, 'update'])->name('session.update');
        Route::delete('/{SessionID}', [SessionController::class, 'delete'])->name('session.delete');

        Route::prefix('{SessionID}/material')->group(function () {
            Route::get('/create', [MaterialController::class, 'create'])->name('material.create');
            Route::post('/store', [MaterialController::class, 'store'])->name('material.store');
            Route::get('/add', [MaterialController::class, 'add'])->name('material.add');
            Route::put('/{MaterialID}', [MaterialController::class, 'update'])->name('material.update');
            Route::delete('/{MaterialID}', [MaterialController::class, 'destroy'])->name('material.destroy');
            Route::get('/edit/{MaterialID}', [MaterialController::class, 'edit'])->name('material.edit');
        });
        Route::prefix('{SessionID}/task')->group(function () {
            Route::get('/create', [TaskController::class, 'create'])->name('task.create');
            Route::post('/store', [TaskController::class, 'store'])->name('task.store');
            Route::get('/add', [TaskController::class, 'add'])->name('task.add');
            Route::put('/{TaskID}', [TaskController::class, 'update'])->name('task.update');
            Route::delete('/{TaskID}', [TaskController::class, 'destroy'])->name('task.destroy');
            Route::get('/edit/{TaskID}', [TaskController::class, 'edit'])->name('task.edit');
        });

        Route::prefix('/{SessionID}/forum')->group(function () {
            Route::get('/', [ForumController::class, 'index'])->name('forum.index');
            Route::post('/create', [ForumController::class, 'store'])->name('forum.store');

            // buat reply
            Route::prefix('/{postId}/reply')->group(function () {
                Route::post('/create', [ForumController::class, 'reply'])->name('forum.reply');
            });
        });
    });

});



Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');
Route::post('/join-course', [CourseController::class, 'join'])->name('join.course');

