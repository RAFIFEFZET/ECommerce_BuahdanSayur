<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class SetSessionConfig
{
    public function handle($request, Closure $next)
    {
        if ($request->is('admin/*')) {
            config(['session.cookie' => Str::slug(env('APP_NAME', 'laravel'), '_') . '_admin_session']);
        } else {
            config(['session.cookie' => Str::slug(env('APP_NAME', 'laravel'), '_') . '_customer_session']);
        }

        return $next($request);
    }
}
