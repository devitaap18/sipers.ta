<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role->role_name === $role) {
            return $next($request);
        }

        return redirect('/login')->withErrors(['accessDenied' => 'Anda tidak memiliki akses ke halaman ini.']);
    }
}
