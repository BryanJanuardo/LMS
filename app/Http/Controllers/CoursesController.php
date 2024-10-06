<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = $this->getCourses();
        $periods = array_keys($courses); 

        return view('courses', ['courses' => $courses, 'periods' => $periods]);
    }

    public function getCoursesByPeriod($period)
    {
        $courses = $this->getCourses();
        if (array_key_exists($period, $courses)) {
            return response()->json($courses[$period]);
        }
        return response()->json([]);
    }

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
