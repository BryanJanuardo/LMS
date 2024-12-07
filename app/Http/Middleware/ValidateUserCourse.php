<?php

namespace App\Http\Middleware;

use App\Models\UserCourse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidateUserCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = Auth::user()->id;
        $courseId = $request->route('CourseID');

        $userCourse = UserCourse::where('UserID', '=', $userId)
        ->where('CourseLearningID', '=', $courseId)
        ->first();

        if(!$userCourse || $userCourse->RoleID != 1) {
            abort(404);
        }

        return $next($request);
    }
}
