<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsModerator
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->isModerator) {
            abort(403);
        }

        return $next($request);
    }
}
