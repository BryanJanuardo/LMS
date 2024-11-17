<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use App\Models\Session;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses', compact('courses'));
    }



    public function show($courseId)
    {

        $course = Course::where('CourseID', $courseId)->firstOrFail();
        $sessions = Session::where('course_id', $courseId)->get();
        $forumPosts = ForumPost::with('replies')->get();
        return view('course-details', compact('course', 'sessions', 'forumPosts'));
    }
// ini cuma buat schedule sementara
    public function getCourses()
    {
        return [
            'Semester 1' => [
                [
                    'courseCode' => 'COMP123',
                    'credit' => '2/2',
                    'className' => 'LA01',
                    'progress' => 70,
                    'title' => 'Framework Architecture Layer',
                    'day' => 'Tuesday',
                    'time' => '13:00-15:00',
                ],
                [
                    'courseCode' => 'COMP456',
                    'credit' => '3/3',
                    'className' => 'LA02',
                    'progress' => 50,
                    'title' => 'Advanced Web Development',
                    'day' => 'Wednesday',
                    'time' => '10:00-12:00',
                ],
                [
                    'courseCode' => 'COMP789',
                    'credit' => '4/4',
                    'className' => 'LA03',
                    'progress' => 90,
                    'title' => 'Data Science and Machine Learning',
                    'day' => 'Thursday',
                    'time' => '09:00-11:00',
                ],
            ],
            'Semester 2' => [
                [
                    'courseCode' => 'COMP654',
                    'credit' => '2/2',
                    'className' => 'LA05',
                    'progress' => 60,
                    'title' => 'Mobile App Development',
                    'day' => 'Monday',
                    'time' => '14:00-16:00',
                ],
                [
                    'courseCode' => 'COMP987',
                    'credit' => '1/1',
                    'className' => 'LA06',
                    'progress' => 80,
                    'title' => 'Cybersecurity Fundamentals',
                    'day' => 'Friday',
                    'time' => '11:00-13:00',
                ],
                [
                    'courseCode' => 'COMP246',
                    'credit' => '3/3',
                    'className' => 'LA07',
                    'progress' => 40,
                    'title' => 'Network Management',
                    'day' => 'Tuesday',
                    'time' => '09:00-11:00',
                ],
            ],


        ];
    }

}
