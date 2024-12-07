<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\CourseLearning;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateCourseIDMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $courseId = $request->route('CourseID');

        if (!CourseLearning::where('id', $courseId)->first() || !$courseId || !is_numeric($courseId)) {
            abort(404);
        }
        return $next($request);
    }
}
