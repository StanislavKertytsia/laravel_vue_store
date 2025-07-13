<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && in_array('admin', auth()->user()->roles ?? [])) {
            return $next($request);
        }
        return response()->json(['message' => 'Forbidden'], 403);
    }
}
