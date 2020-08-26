<?php

namespace App\Http\Middleware;

use Closure;

class Agente
{
    public function handle($request, Closure $next)
    {
        if ((Auth()->user()->tipo == "agente" && Auth()->user()->idAgente != null) || (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null)) {
            return $next($request);
        }

        return abort(403);
    }
}
