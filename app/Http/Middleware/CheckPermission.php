<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AppRoute;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle($request, Closure $next)
{
    $user = auth()->user();
    $path = '/' . ltrim($request->path(), '/');
    $method = $request->method();

    $route = AppRoute::where('path', $path)
    ->where('method', strtoupper($method))
    ->first();

    if (!$route) {
        return response()->json(['message' => 'غير مسموح'], 403);
    }

    $permission = $route->permission;

    if (!$permission || !$user->role->permissions->contains($permission)) {
        return response()->json(['message' => 'صلاحية غير كافية'], 403);
    }

    return $next($request);
}

}
