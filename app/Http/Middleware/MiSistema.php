<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class MiSistema
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $sistema)
    {
        if (auth()->user()->sistema->nombre == $sistema) {
            return $next($request);
        }
        throw UnauthorizedException::sin_permisos();
    }
}
