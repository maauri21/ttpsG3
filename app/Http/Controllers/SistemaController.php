<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class SistemaController extends Controller
{
    public function administrarsistema($id) {
        $salas=App\Models\Sala::where('sistema_id', '=', $id)->get();
        $cantSalas=App\Models\Sala::where('sistema_id', '=', $id)->count();
        $sistema=App\Models\Sistema::findOrFail($id);
        $camas=App\Models\Cama::all();

        # Cuento las del sistema donde estoy
        $total=0;
        $libres=0;
        $ocupadas=0;
        foreach ($camas as $cama) {
            if ($cama->sala->sistema->id == $id) {
                $total++;
                if ($cama->paciente_id == NULL) {
                    $libres++;
                }
                else {
                    $ocupadas++;
                }
            }
        }

        $usuarios=App\Models\User::where('sistema_id', '=', $id)->get();

        $jefe='';
        foreach ($usuarios as $jefe) {
            if($jefe->hasRole('jefe')) {
                break;
            }
        }

        return view('sistemas.administrarsistema',compact('salas','cantSalas','sistema','total','libres','ocupadas','jefe'));
    }

    public function cambio_obito($id) {

        $paciente=App\Models\Paciente::findOrFail($id);
        $sistemaActual = $paciente->sistemas()->latest('id')->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);

        # Pongo fecha fin en el sistema actual
        $paciente->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);

        # Dejo NULL la cama que ocupaba
        $cama=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
        $cama->paciente_id = NULL;
        $cama->save();

        # Cierro internación por obito
        $internacion=App\Models\Internacion::where('paciente_id', '=', $paciente->id)->first();
        $internacion->fObito = date('Y-m-d');
        $internacion->save();

        $url = route('administrarsistema', ['id' => $sistemaActual->pivot->sistema_id]);
        return redirect($url)->with('mensaje','Óbito registrado');

    }
}
