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
    
        // المسار بصيغته الثابتة من Laravel
        $routePath ='/'.$request->route()->uri(); // مثال: api/users/change-role/{id}
        $method = $request->method();          // مثال: PUT أو POST
        
        $route = AppRoute::where('path',$routePath)
        ->where('method', strtoupper($method))
        ->first();
      
        if (!$route) {
            return response()->json(['message' => 'غير مسموح'], 403);
        }
    
        $permission = $route->permission;
    
        if (!$permission || !$user->role->permissions->contains($permission)) {
            return response()->json(['message' => 'الصلاحية غير كافية'], 403);
        }
    
        return $next($request);
    }
}
