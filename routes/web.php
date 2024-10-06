<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');

Route::get('/forum', [ForumController::class, 'index'])->name('forum');

Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
Route::get('/courses/{period}', [CoursesController::class, 'getCoursesByPeriod'])->name('courses.period');
