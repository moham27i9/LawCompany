<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JustClient
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || $user->role_id != 2) {
            return response()->json([
                'message' => 'Unauthorized. Only client can access.'
            ], 403);
        }

        return $next($request);
    }
}
