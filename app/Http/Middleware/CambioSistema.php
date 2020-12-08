<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App;

class CambioSistema
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
        $paciente=App\Models\Paciente::findOrFail($id);
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('id', 'desc')->first();
        $sistemaActual = $internacion->sistemas()->wherePivot('fin', NULL)->first();
        if (auth()->user()->sistema->nombre == $sistemaActual->nombre) {
            return $next($request);
        }
        throw UnauthorizedException::sin_permisos();
    }
}
