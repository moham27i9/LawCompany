<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
  
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();
  
    if (!$user || !in_array(strtolower($user->role->name), array_map('strtolower', $roles))) {
        return response()->json(['message' => 'Unauthorized.'], 403);
    }
    
        return $next($request);
    }
    
}
