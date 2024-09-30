<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Schedule;
use App\Http\Controllers\Forum;
use App\Http\Controllers\Courses;
use Illuminate\Support\Facades\Route;

Route::get('/', [Dashboard::class, 'index'])->name('dashboard');

Route::get('/schedule', [Schedule::class, 'index'])->name('schedule');
Route::get('/forum', [Forum::class, 'index'])->name('forum');
Route::get('/courses', [Courses::class, 'index'])->name('courses');
