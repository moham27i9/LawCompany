<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsApplicant
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user->lawyer || $user->employee) {
            return response()->json([
                'message' => 'غير مصرح لك بالتقديم لأنك موظف أو محامي بالفعل'
            ], 403);
        }
       

        return $next($request);
    }
}

