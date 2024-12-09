<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseLearning;
use App\Models\UserCourse;
use Carbon\Carbon;
use App\Models\SessionLearning;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $todayCourses = UserCourse::where('UserID', Auth::user()->id)
        ->join('course_learnings', 'user_courses.CourseLearningID', '=', 'course_learnings.id')
        ->join('courses', 'course_learnings.CourseID', '=', 'courses.CourseID')
        ->join('session_learnings', 'course_learnings.id', '=', 'session_learnings.CourseLearningID')
        ->join('sessionses', 'session_learnings.SessionID', '=', 'sessionses.SessionID')
        ->where('sessionses.SessionStart', '>=', Carbon::now())
        ->where('sessionses.SessionEnd', '<', Carbon::tomorrow())
        ->select('course_learnings.id', 'courses.CourseName', 'course_learnings.ClassName', 'sessionses.SessionStart', 'sessionses.SessionEnd')
        ->paginate(8);

        $enrolledCourses = UserCourse::where('UserID', Auth::user()->id)->get();

        $availableCourses = UserCourse::join('course_learnings', 'user_courses.CourseLearningID', '=', 'course_learnings.id')
        ->join('courses', 'course_learnings.CourseID', '=', 'courses.CourseID')
        ->join('users', 'user_courses.UserID', '=', 'users.id')
        ->where('user_courses.RoleID', 1)
        ->where('user_courses.UserID', '!=', Auth::user()->id)
        ->whereNotIn('user_courses.CourseLearningID', $enrolledCourses->pluck('CourseLearningID'))
        ->select(
            'course_learnings.id as CourseLearningID',
            'courses.CourseName',
            'courses.CourseDescription',
            'course_learnings.ClassName',
            'course_learnings.created_at',
            'users.UserName',
            'user_courses.RoleID',
            DB::raw('(SELECT COUNT(*) FROM user_courses WHERE user_courses.CourseLearningID = course_learnings.id) as TotalCountUserEnrolled'),
            DB::raw('(SELECT COUNT(*) FROM session_learnings WHERE session_learnings.CourseLearningID = course_learnings.id) as TotalCountSessions')
        )
        ->paginate(8);

        return view('Dashboard')->with(['todayCourses' => $todayCourses, 'availableCourses' => $availableCourses]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $todayCourses = UserCourse::where('UserID', Auth::user()->id)
        ->join('course_learnings', 'user_courses.CourseLearningID', '=', 'course_learnings.id')
        ->join('courses', 'course_learnings.CourseID', '=', 'courses.CourseID')
        ->join('session_learnings', 'course_learnings.id', '=', 'session_learnings.CourseLearningID')
        ->join('sessionses', 'session_learnings.SessionID', '=', 'sessionses.SessionID')
        ->where('sessionses.SessionStart', '>=', Carbon::now())
        ->where('sessionses.SessionEnd', '<', Carbon::tomorrow())
        ->select('course_learnings.id', 'courses.CourseName', 'course_learnings.ClassName', 'sessionses.SessionStart', 'sessionses.SessionEnd')
        ->paginate(8);

        $enrolledCourses = UserCourse::where('UserID', Auth::user()->id)->get();

        $availableCourses = UserCourse::join('course_learnings', 'user_courses.CourseLearningID', '=', 'course_learnings.id')
        ->join('courses', 'course_learnings.CourseID', '=', 'courses.CourseID')
        ->join('users', 'user_courses.UserID', '=', 'users.id')
        ->where('user_courses.RoleID', 1)
        ->where('user_courses.UserID', '!=', Auth::user()->id)
        ->whereNotIn('user_courses.CourseLearningID', $enrolledCourses->pluck('CourseLearningID'))
        ->select(
            'course_learnings.id as CourseLearningID',
            'courses.CourseName',
            'courses.CourseDescription',
            'course_learnings.ClassName',
            'course_learnings.created_at',
            'users.UserName',
            'user_courses.RoleID',
            DB::raw('(SELECT COUNT(*) FROM user_courses WHERE user_courses.CourseLearningID = course_learnings.id) as TotalCountUserEnrolled'),
            DB::raw('(SELECT COUNT(*) FROM session_learnings WHERE session_learnings.CourseLearningID = course_learnings.id) as TotalCountSessions')
        )
        ->where('courses.CourseName', 'like', '%' . $searchTerm . '%')
        ->paginate(8);

        return view('Dashboard')->with(['todayCourses' => $todayCourses, 'availableCourses' => $availableCourses]);
    }

}
