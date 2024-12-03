<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Http\Controllers\CourseController;

use Illuminate\Http\Request;
class ScheduleController extends Controller
{
    public function index()
{
    $schedules = Schedule::all();
    return view('schedule', compact('schedules'));
}

public function show($id)
{
    $schedule = Schedule::findOrFail($id);
    $announcements = $schedule->announcements;
    return response()->json([
        'schedule' => $schedule,
        'announcements' => $announcements,
    ]);
}

}
