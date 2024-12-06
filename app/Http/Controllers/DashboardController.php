<?php

namespace App\Http\Controllers;

use App\Models\UserCourse;
use Carbon\Carbon;
use App\Models\SessionLearning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $classes = UserCourse::where('UserID', Auth::user()->id)
        ->join('course_learnings', 'user_courses.CourseLearningID', '=', 'course_learnings.id')
        ->join('courses', 'course_learnings.CourseID', '=', 'courses.CourseID')
        ->join('session_learnings', 'course_learnings.id', '=', 'session_learnings.CourseLearningID')
        ->join('sessionses', 'session_learnings.SessionID', '=', 'sessionses.SessionID')
        ->where('sessionses.SessionStart', '>=', Carbon::now())
        ->where('sessionses.SessionEnd', '<', Carbon::tomorrow())
        ->select('course_learnings.id', 'courses.CourseName', 'course_learnings.ClassName', 'sessionses.SessionStart', 'sessionses.SessionEnd')
        ->get();

        $announcements = [
            [
                'title' => 'Open Enrollment SLC 2024',
                'content' => 'Informasi dikit tentang announcementnya',
            ],
            [
                'title' => 'Important Update on Course Materials',
                'content' => 'Please check the updated syllabus on the portal.',
            ],
            [
                'title' => 'Exam Schedule Released',
                'content' => 'The exam schedule has been posted on the notice board.',
            ],
            [
                'title' => 'Guest Lecture Next Week',
                'content' => 'Join us for a guest lecture on Cloud Computing.',
            ],
        ];

        return view('dashboard')->with('classes', $classes)->with('announcements', $announcements);
    }
}
