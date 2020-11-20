<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\EvolucionNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\Evolucion;
use App\Models\User;
use App\Events\EvolucionEvent;

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

        $evolucion = new App\Models\Evolucion;
        #$pacienteNuevo->dni = $request->dni;
        #$pacienteNuevo->contacto()->associate($contactoNuevo);
        #$pacienteNuevo->save();
        $evolucion->temperatura = $request->temperatura;
        $evolucion->tasistolica = $request->tasistolica;
        $evolucion->tadiastolica = $request->tadiastolica;
        $evolucion->fc = $request->fc;
        $evolucion->fr = $request->fr;
        $evolucion->canulanasal = $request->canulanasal;
        $evolucion->mascarares = $request->mascarares;
        $evolucion->sato2 = $request->sato2;
        $evolucion->valorpafi = $request->valorpafi;

        if ($request->somnolencia) {
            $evolucion->textoAlerta = "Somnolencia: evaluar pase a UTI";
        }

        #$evolucion->save();
        #$data = $request->all();
        #$aux = Evolucion::create($data);
        #auth()->user()->notify(new EvolucionNotification($evolucion));
        #User::all()
        #    ->except()
        event (new EvolucionEvent($evolucion));
        return ("Evolucion cargada");
        #return redirect()->route('verinternacion', ['id' => $pacienteNuevo->id]);

    }

    public function mostrarevolucion(){
        $evolucionNotifications = auth()->user()->unreadNotifications;
        return view('evoluciones.verevolucion', compact('evolucionNotifications')); 
    }


    public function MarkAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
        }

}
