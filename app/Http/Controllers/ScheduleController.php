<?php

namespace App\Http\Controllers;

use App\Models\UserCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    public function getListCourses(Request $req)
    {
        $userId = Auth::id();
        $dateStart = Carbon::parse($req->DateStart)->setTimezone('UTC');
        $dateEnd = Carbon::parse($req->DateEnd)->setTimezone('UTC');

        // Optimized query to get the sessions directly based on user and date range
        $sessions = UserCourse::where('UserID', $userId)
            ->join('course_learnings', 'user_courses.CourseLearningID', '=', 'course_learnings.id')
            ->join('courses', 'course_learnings.CourseID', '=', 'courses.CourseID')
            ->join('session_learnings', 'course_learnings.id', '=', 'session_learnings.CourseLearningID')
            ->join('sessionses', 'session_learnings.SessionID', '=', 'sessionses.SessionID')
            ->where('sessionses.SessionStart', '>=', $dateStart)
            ->where('sessionses.SessionEnd', '<=', $dateEnd)
            ->select('courses.CourseName', 'course_learnings.id', 'sessionses.SessionDescription', 'sessionses.SessionStart', 'sessionses.SessionEnd')
            ->get();

        // Mapping the sessions to the events array
        $events = $sessions->map(function ($session) {
            return [
                'id' => $session->id,
                'title' => $session->CourseName,
                'start' => $session->SessionStart,
                'end' => $session->SessionEnd,
                'description' => $session->SessionDescription ?? ''
            ];
        });

        return response()->json($events);
    }


    public function index()
    {
        return view('schedule');
    }
}
