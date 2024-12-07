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
use App\Http\Middleware\AuthenticationMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\ValidateCourseIDMiddleware;
use App\Http\Middleware\ValidateForumIDMiddleware;
use App\Http\Middleware\ValidateMaterialIDMiddleware;
use App\Http\Middleware\ValidateSessionIDMiddleware;
use App\Http\Middleware\ValidateTaskIDMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('register.index');
    Route::post('/register', [UserController::class, 'create'])->name('register.store');
    Route::get('/login', [UserController::class, 'login'])->name('login.index');
    Route::post('/login', [UserController::class, 'auth'])->name('login.store');
});

Route::middleware(AuthenticationMiddleware::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [DashboardController::class, 'search'])->name('dashboard.search');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/getListCourses', [ScheduleController::class, 'getListCourses'])->name('schedule.getListCourses');
    Route::get('/task', [TaskController::class, 'index'])->name('task.index');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::prefix('/course')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('course.index');
        Route::get('/create', [CourseController::class, 'create'])->name('course.create');
        Route::post('/store', [CourseController::class, 'store'])->name('course.store');
        Route::get('/management', [CourseController::class, 'manage'])->name('course.management');
        Route::get('/session', [SessionController::class, 'course'])->name('session.course');
        Route::post('/enroll', [CourseController::class, 'enroll'])->name('course.enroll');

        Route::prefix('/{CourseID}')->group(function () {
            Route::middleware(ValidateCourseIDMiddleware::class)->group(function () {
                Route::get('/', [CourseController::class, 'detail'])->name('course.detail');
                Route::get('/edit', [CourseController::class, 'edit'])->name('course.edit');
                Route::put('/update', [CourseController::class, 'update'])->name('course.update');
                Route::delete('/destroy', [CourseController::class, 'destroy'])->name('course.destroy');
                Route::get('/session/management', [SessionController::class, 'manage'])->name('session.management');

                Route::prefix('/session')->group(function () {
                    Route::get('/create', [SessionController::class, 'create'])->name('session.create');
                    Route::post('/store', [SessionController::class, 'store'])->name('session.store');

                    Route::prefix('/{SessionID}')->group(function () {
                        Route::middleware(ValidateSessionIDMiddleware::class)->group(function () {
                            Route::get('/', [SessionController::class, 'index'])->name('session.show');
                            Route::put('/', [SessionController::class, 'update'])->name('session.update');
                            Route::delete('/', [SessionController::class, 'delete'])->name('session.delete');

                            Route::prefix('/material')->group(function () {
                                Route::get('/create', [MaterialController::class, 'create'])->name('material.create');
                                Route::post('/store', [MaterialController::class, 'store'])->name('material.store');
                                Route::get('/add', [MaterialController::class, 'add'])->name('material.add');

                                Route::prefix('/{MaterialID}')->group(function () {
                                    Route::middleware(ValidateMaterialIDMiddleware::class)->group(function () {
                                        Route::get('/edit', [MaterialController::class, 'edit'])->name('material.edit');
                                        Route::put('/', [MaterialController::class, 'update'])->name('material.update');
                                        Route::delete('/', [MaterialController::class, 'destroy'])->name('material.destroy');
                                    });
                                });
                            });

                            Route::prefix('/task')->group(function () {
                                Route::get('/create', [TaskController::class, 'create'])->name('task.create');
                                Route::post('/store', [TaskController::class, 'store'])->name('task.store');
                                Route::get('/add', [TaskController::class, 'add'])->name('task.add');

                                Route::prefix('/{TaskID}')->group(function () {
                                    Route::middleware(ValidateTaskIDMiddleware::class)->group(function () {
                                        Route::get('/edit', [TaskController::class, 'edit'])->name('task.edit');
                                        Route::put('/', [TaskController::class, 'update'])->name('task.update');
                                        Route::delete('/', [TaskController::class, 'destroy'])->name('task.destroy');
                                    });
                                });
                            });

                            Route::prefix('/forum')->group(function () {
                                Route::get('/', [ForumController::class, 'index'])->name('forum.index');
                                Route::post('/create', [ForumController::class, 'store'])->name('forum.store');

                                Route::prefix('/{postId}/reply')->group(function () {
                                    Route::middleware(ValidateForumIDMiddleware::class)->group(function () {
                                        Route::post('/create', [ForumController::class, 'reply'])->name('forum.reply');
                                    });
                                });
                            });
                        });
                    });
                });
            });
        });
    });
});


