<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role->name !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized. Admin access only.'
            ], 403);
        }

        return $next($request);
    }
}
