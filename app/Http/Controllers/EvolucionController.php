<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\EvolucionNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\Evolucion;
use App\Models\User;
use App\Events\EvolucionEvent;

use App;
use Carbon\Carbon;

class EvolucionController extends Controller
{
    public function cargar_evolucion($id) {
        $paciente=App\Models\Paciente::findOrFail($id);
        $sistemaActual = $paciente->sistemas()->wherePivot('fin', NULL)->first();
        return view('evoluciones.cargarevolucion',compact('sistemaActual', 'id'));
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


        $evolucion = new App\Models\Evolucion;
        $internacion=App\Models\Internacion::where('paciente_id', '=', $request->paciente)->orderBy('fInternacion', 'desc')->first();
        $config= App\Models\Config::findOrFail(1);
        $paciente=App\Models\Paciente::findOrFail($request->paciente);

        $evolucion->fecha = date('Y-m-d');
        $evolucion->hora = date("H:i");
        $evolucion->temperatura = $request->temperatura;
        $evolucion->tasistolica = $request->tasistolica;
        $evolucion->tadiastolica = $request->tadiastolica;
        $evolucion->fc = $request->fc;
        $evolucion->fr = $request->fr;
        $evolucion->mecanicaventilatoria = $request->mecanicaventilatoria;
        $evolucion->o2suplementario = $request->o2suplementario;
        $evolucion->canulanasal = $request->canulanasal;
        $evolucion->mascarares = $request->mascarares;
        $evolucion->sato2 = $request->sato2;
        $evolucion->pafi = $request->pafi;
        $evolucion->valorpafi = $request->valorpafi;
        $evolucion->pronovigil = $request->pronovigil;
        $evolucion->tos = $request->tos;
        $evolucion->disnea = $request->disnea;
        $evolucion->desaresp = $request->desaresp;
        $evolucion->somnolencia = $request->somnolencia;
        $evolucion->anosmia = $request->anosmia;
        $evolucion->disgeusia = $request->disgeusia;
        $evolucion->rxtx = $request->rxtx;
        $evolucion->tiporxtx = $request->tiporxtx;
        $evolucion->descripcionrx = $request->descripcionrx;
        $evolucion->tactorax = $request->tactorax;
        $evolucion->tipotactorax = $request->tipotactorax;
        $evolucion->descripciontactorax = $request->descripciontactorax;
        $evolucion->ecg = $request->ecg;
        $evolucion->tipoecg = $request->tipoecg;
        $evolucion->descripcionecg = $request->descripcionecg;
        $evolucion->pcr = $request->pcr;
        $evolucion->tipopcr = $request->tipopcr;
        $evolucion->descripcionpcr = $request->descripcionpcr;
        $evolucion->descripcionobs = $request->descripcionobs;
        $evolucion->arm = $request->arm;
        $evolucion->descripcionArm = $request->descripcionArm;
        $evolucion->traqueostomia = $request->traqueostomia;
        $evolucion->vasopresores = $request->vasopresores;
        $evolucion->descripcionVasop = $request->descripcionVasop;
        $evolucion->paciente_alerta = $request->paciente;

        $evolucion->internacion()->associate($internacion);
        $evolucion->save();

        # regla 1
        if ($request->somnolencia) {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Somnolencia: evaluar pase a UTI";
            event (new EvolucionEvent($evolucion));
        }

        # regla 2
        if ($request->mecanicaventilatoria != 'buena') {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Mecánica ventilatoria $request->mecanicaventilatoria: evaluar pase a UTI";
            event (new EvolucionEvent($evolucion));
        }
        
        # regla 4
        $dia_sintomas = Carbon::createFromFormat('Y-m-d', $internacion->fIniciosintomas)->addDays(10);
        $dia_sintomas = $dia_sintomas->format('Y-m-d');
        $hoy = Carbon::now()->format('Y-m-d');
        if ($dia_sintomas == $hoy) {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Pasaron 10 dias de inicio de sintomas: evaluar alta";
            event (new EvolucionEvent($evolucion));
        }

        # regla 5
        if ($request->sato2 < $config->sat_o2) {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Saturación de oxígeno menor a $config->sat_o2: evaluar oxígeno, terapia y prono";
            event (new EvolucionEvent($evolucion));
        }

        return redirect()->route('verinternacion', ['id' => $request->paciente])->with('mensaje','Evolución cargada');
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
