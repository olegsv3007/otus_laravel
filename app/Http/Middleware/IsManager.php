<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsManager
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->isManager) {
            abort(403);
        }

        return $next($request);
    }
}
