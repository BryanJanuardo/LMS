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
    private function getClassName(){
        $class = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        return $class[rand(0, 25)] . $class[rand(0, 25)] . '-' . str_pad(rand(1, 100), 2, '0', STR_PAD_LEFT);
    }

    private function toAcronym(string $str){
        $words = explode(' ', $str);

        $acronym = array_reduce($words, function ($carry, $word) {
            return $carry . strtoupper($word[0]);
        }, '');

        return substr($acronym, 0, 3);
    }

    private function getCourseId(string $courseName){
        $acronym = $this->toAcronym($courseName);
        $course = Course::where('CourseID', 'like', $acronym . '%')->latest()->first();

        $latestCourseID = $course ? substr($course->CourseID, 3) : 0;
        $newCourseID = $acronym . str_pad((intval($latestCourseID) + 1), 3, '0', STR_PAD_LEFT);
        return $newCourseID;
    }

    private function getClassId(){

    }

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
        $userId = Auth::user()->id;
        $courses = UserCourse::where('UserID', '=', $userId)
        ->where('RoleID', '=', 1)
        ->get();

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

        $newCourse = Course::create([
            'CourseID' => $this->getCourseId($request->CourseName),
            'CourseName' => $request->CourseName,
            'CourseDescription' => $request->CourseDescription,
            'SKS' => $request->SKS
        ]);

        $newCourseLearning = CourseLearning::create([
            'CourseID' => $newCourse->CourseID,
            'ClassName' => $this->getClassName()
        ]);

        UserCourse::create([
            'UserID' => Auth::user()->id,
            'CourseLearningID' => $newCourseLearning->id,
            'RoleID' => 1
        ]);

        return redirect(route('course.management'));
    }

    public function edit($courseID){
        $course = CourseLearning::find($courseID);
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

