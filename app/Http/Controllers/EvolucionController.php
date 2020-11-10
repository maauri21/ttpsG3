<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class EvolucionController extends Controller
{
    public function cargar_evolucion($id) {
        $paciente=App\Models\Paciente::findOrFail($id);
        $sistemaActual = $paciente->sistemas()->wherePivot('fin', NULL)->first();
        return view('evoluciones.cargarevolucion',compact('sistemaActual'));
    }

    public function cargar_evolucion2(Request $request) {
        $request->validate([
            'temperatura' => 'required | numeric | between:0,9.9',
            'tasistolica' => 'required | numeric | digits_between:1,3',
            'tadiastolica' => 'required | numeric | digits_between:1,3',
            'fc' => 'required | numeric | digits_between:1,3',
            'fr' => 'required | numeric | digits_between:1,3',
            'canulanasal' => 'nullable | numeric | between:1,6',
            'mascarares' => 'nullable | numeric | between:1,100',
            'sato2' => 'numeric | between:0,100',
            'valorpafi' => 'nullable | numeric',
        ]);

        # HORA Y FECHA AUTOMÁTICO!

        #$evolucion = new App\Models\Evolucion;
        #$pacienteNuevo->dni = $request->dni;
        #$pacienteNuevo->contacto()->associate($contactoNuevo);
        #$pacienteNuevo->save();

        #return redirect()->route('verinternacion', ['id' => $pacienteNuevo->id]);

    }
}
