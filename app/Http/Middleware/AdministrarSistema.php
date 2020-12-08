<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App;

class AdministrarSistema
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
        $sistema= App\Models\Sistema::findOrFail($id);
        if (auth()->user()->hasRole('medico'))
            if (auth()->user()->sistema->nombre != $sistema->nombre) {
                throw UnauthorizedException::sin_permisos();
            }
        
        return $next($request);
    }
}
