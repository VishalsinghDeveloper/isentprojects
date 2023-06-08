<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class UserMiddleware
{
    
    public function handle($request, Closure $next)
    {
        if (auth('sanctum')->check() && auth('sanctum')->user()->status === 1) {
            return $next($request);
        }
        return response()->json([
            'status' => false,
            'error' => 'Sorry, Your account has been Blocked. Please contact the administrator.'
        ], 403);
    }
}
