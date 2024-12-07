<?php

namespace App\Http\Middleware;

use App\Models\TaskLearning;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateTaskIDMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $taskId = $request->route('TaskID');

        if (!TaskLearning::where('TaskID', $taskId)->first() || !$taskId || !is_numeric($taskId)) {
            abort(404);
        }
        return $next($request);
    }
}
