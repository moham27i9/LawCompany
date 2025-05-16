<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JustLawyers
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
 
        if ($user->role->name !== 'lawyer') {
            return response()->json(['message' => 'لم يتم تفعيلك كمحامي بعد.يجب عليك إكمال ملفك الشخصي'], 403);
        }

        return $next($request);
    }
}

