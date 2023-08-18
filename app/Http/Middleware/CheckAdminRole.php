<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // CheckAdminRole.php
    // public function handle($request, Closure $next, ...$roleValues)
    // {
    //     $userRoleValue = auth()->user()->role->role_value;
    
    //     if (!in_array($userRoleValue, $roleValues)) {
    //         abort(403, 'Unauthorized.');
    //     }
    
    //     return $next($request);
    // }
    
}
