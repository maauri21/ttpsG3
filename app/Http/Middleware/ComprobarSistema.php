<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App;

class ComprobarSistema
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        $usuario= App\Models\User::findOrFail($id);
        if (auth()->user()->sistema->nombre == $usuario->sistema->nombre) {
            return $next($request);
        }
        throw UnauthorizedException::sin_permisos();
    }
}
