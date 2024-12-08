<?php

namespace App\Http\Middleware;

use App\Models\SessionLearning;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateSessionIDMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionId = $request->route('SessionID');

        if (!SessionLearning::where('id', $sessionId)->first() || !$sessionId || !is_numeric($sessionId)) {
            abort(404);
        }
        return $next($request);
    }
}
