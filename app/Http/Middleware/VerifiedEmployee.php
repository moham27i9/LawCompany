<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (!in_array($user->role->name, ['hr', 'accountant']) || !$user->employee) {
            return response()->json(['message' => 'لم يتم تفعيل بياناتك كموظف بعد.'], 403);
        }
        return $next($request);
    }
}
