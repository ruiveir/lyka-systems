<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null) {
            return $next($request);
        }

        return abort(403);
    }
}
