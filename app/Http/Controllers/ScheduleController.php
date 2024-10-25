<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class ScheduleController extends Controller
{
    public function index()
    {
        $coursesController = new CourseController();
        $courses = $coursesController->getCourses();

        $semesters = array_keys($courses);
        $lastSemester = end($semesters);

        $schedules = [];

        if (array_key_exists($lastSemester, $courses)) {
            foreach ($courses[$lastSemester] as $course) {
                $schedules[] = [
                    'courseCode' => $course['courseCode'],
                    'title' => $course['title'],
                    'day' => $course['day'],
                    'time' => $course['time'],
                ];
            }
        }

        return view('schedule', ['schedules' => $schedules, 'semester' => $lastSemester]);
    }
}
