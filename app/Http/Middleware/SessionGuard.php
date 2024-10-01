<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionGuard
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard) {
            Auth::shouldUse($guard);
            session()->put('auth_guard', $guard);
        }

        return $next($request);
    }
}
