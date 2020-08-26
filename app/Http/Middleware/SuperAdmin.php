<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin) {
            return $next($request);
        }

        return abort(403);
    }
}
