<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CourseController;

class ScheduleController extends Controller
{
    public function index()
    {
        $CourseController = new CourseController();
        $courses = $CourseController->getCourses();

        $semesters = array_keys($courses);
        $lastSemester = end($semesters);

        $schedules = [];

        if (array_key_exists($lastSemester, $courses)) {
            foreach ($courses[$lastSemester] as $course) {
                $schedules[] = [
                    'courseCode' => $course['courseCode'],
                    'title' => $course['title'],
                    'sessionStart' => $course['sessionStart']->format('d M Y, H:i'), 
                    'sessionEnd' => $course['sessionEnd']->format('d M Y, H:i'),
                ];
            }
        }

        return view('schedule', ['schedules' => $schedules, 'semester' => $lastSemester]);
    }
}
