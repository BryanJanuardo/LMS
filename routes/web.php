<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Dashboard::class, 'index'])->name('dashboard');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');

Route::prefix('/course/{CourseID}/session')->group(function () {
    Route::get('/{SessionID}', [SessionController::class, 'index'])->name('session');
    Route::post('/create', [SessionController::class, 'store'])->name('session.store');
    Route::put('/{SessionID}', [SessionController::class, 'update'])->name('session.update');
    Route::delete('/{SessionID}', [SessionController::class, 'delete'])->name('session.delete');
});
