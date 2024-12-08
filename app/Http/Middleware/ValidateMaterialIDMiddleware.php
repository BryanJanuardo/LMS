<?php

namespace App\Http\Middleware;

use App\Models\Material;
use App\Models\MaterialLearning;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateMaterialIDMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $materialId = $request->route('MaterialID');

        if (!MaterialLearning::where('MaterialID', $materialId)->first() || !$materialId) {
            abort(404);
        }
        return $next($request);
    }
}
