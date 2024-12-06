<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLearning;
use App\Models\ForumPost;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // public function getCoursesByPeriod($period)
    // {
    //     $courses = $this->getCourses();
    //     if (array_key_exists($period, $courses)) {
    //         return response()->json($courses[$period]);
    //     }
    //     return response()->json([]);
    // }
    public function index(){
        $courses = UserCourse::where('UserID', '=', Auth::user()->id)->get();
        return view('Courses', ['courses' => $courses]);
    }

    public function manage(){
        $courses = Course::all();
        return view('CoursesManagement', ['courses' => $courses]);
    }

    public function detail($courseID){
        $usercourse = UserCourse::where('CourseLearningID', $courseID)
        ->where('UserID', Auth::user()->id)
        ->first();


        $course = $usercourse->courseLearning;
        return view('CourseDetail', ['course' => $course]);
    }

    public function create(){
        return view('CourseCreate');
    }

    public function store(Request $request){
        $data = $request->validate([
            'CourseName' => 'required',
            'CourseDescription' => 'required',
            'SKS' => 'required|numeric'
        ]);

        $newCourse = Course::create($data);
        // dd($request);
        return redirect(route('course.management'));
    }

    public function edit($courseID){
        // dd($courseID);
        $course = Course::find($courseID);
        return view('CourseEdit', ['course' => $course]);
    }

    public function update(Course $course, Request $request){
        $data = $request->validate([
            'CourseName' => 'required',
            'CourseDescription' => 'required',
            'SKS' => 'required|numeric'
        ]);

        $course->update($data);
        return redirect(route('course.management'));
    }

    public function destroy($courseID){
        $course = Course::find($courseID);
        $course->delete();
        return redirect(route('course.management'));
    }

    
}

