<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JustLawyers
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || $user->role_id != 5) {
            return response()->json([
                'message' => 'Unauthorized. Only lawyers can access this route.'
            ], 403);
        }

        return $next($request);
    }
}

