<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');

// Route::get('/forum', [ForumController::class, 'index'])->name('forum');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');

Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/course/{courseId}', [CourseController::class, 'show'])->name('course.show');

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
Route::post('/forum/{postId}/reply', [ForumController::class, 'reply'])->name('forum.reply');

Route::prefix('/course/{CourseID}/session')->group(function () {
    Route::get('/{SessionID}', [SessionController::class, 'index'])->name('session.show');
    Route::post('/create', [SessionController::class, 'store'])->name('session.store');
    Route::put('/{SessionID}', [SessionController::class, 'update'])->name('session.update');
    Route::delete('/{SessionID}', [SessionController::class, 'delete'])->name('session.delete');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/task', [TaskController::class, 'index'])->name('tasks');


// Route::get('/course/{courseCode}', [CourseDetailController::class, 'showCourseDetails']);
