<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowedRolesMiddleware
{
    /**
     * Handle an incoming request.
     * ;IUY9E5657T7PHIG,K786
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
      
        $user = $request->user();
        if ($user->role == 'admin') {
          return $next($request);
        }
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'Unauthorized!.'], 403);
        }   
        return $next($request);
    }
}

