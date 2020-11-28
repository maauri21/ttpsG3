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
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('fInternacion', 'desc')->first();
        $evolucion=App\Models\Evolucion::where('internacion_id', '=', $internacion->id)->orderBy('id', 'desc')->first();
        return view('evoluciones.cargarevolucion',compact('sistemaActual', 'id', 'evolucion'));
    }

    public function cargar_evolucion2(Request $request) {
        $request->validate([
            'temperatura' => 'required | numeric | between:0,99.9',
            'tasistolica' => 'required | numeric | digits_between:1,3',
            'tadiastolica' => 'required | numeric | digits_between:1,3',
            'fc' => 'required | numeric | digits_between:1,3',
            'fr' => 'required | numeric | between:0,100',
            'canulanasal' => 'nullable | numeric | between:1,6',
            'mascarares' => 'nullable | numeric | between:1,100',
            'sato2' => 'numeric | between:0,100',
            'valorpafi' => 'nullable | numeric',
        ]);


        $evolucion = new App\Models\Evolucion;
        $internacion=App\Models\Internacion::where('paciente_id', '=', $request->paciente)->orderBy('fInternacion', 'desc')->first();
        $ultimaEvolucion=App\Models\Evolucion::where('internacion_id', '=', $internacion->id)->orderBy('id', 'desc')->first();
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
        $evolucion->o2suplementario = ($request->o2suplementario) ? 1 : 0;
        $evolucion->canulanasal = $request->canulanasal;
        $evolucion->mascarares = $request->mascarares;
        $evolucion->sato2 = $request->sato2;
        $evolucion->pafi = ($request->pafi) ? 1 : 0;
        $evolucion->valorpafi = $request->valorpafi;
        $evolucion->pronovigil = ($request->pronovigil) ? 1 : 0;
        $evolucion->tos = ($request->tos) ? 1 : 0;
        $evolucion->disnea = $request->disnea;
        $evolucion->desaresp = ($request->desaresp) ? 1 : 0;
        $evolucion->somnolencia = ($request->somnolencia) ? 1 : 0;
        $evolucion->anosmia = ($request->anosmia) ? 1 : 0;
        $evolucion->disgeusia = ($request->disgeusia) ? 1 : 0;
        $evolucion->rxtx = ($request->rxtx) ? 1 : 0;
        $evolucion->tiporxtx = $request->tiporxtx;
        $evolucion->descripcionrx = $request->descripcionrx;
        $evolucion->tactorax = ($request->tactorax) ? 1 : 0;
        $evolucion->tipotactorax = $request->tipotactorax;
        $evolucion->descripciontactorax = $request->descripciontactorax;
        $evolucion->ecg = ($request->ecg) ? 1 : 0;
        $evolucion->tipoecg = $request->tipoecg;
        $evolucion->descripcionecg = $request->descripcionecg;
        $evolucion->pcr = ($request->pcr) ? 1 : 0;
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

        # regla 1
        if ($request->somnolencia and $config->somnolencia) {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Somnolencia: evaluar pase a UTI";
            event (new EvolucionEvent($evolucion));
        }

        # regla 2
        if ($request->mecanicaventilatoria != 'buena' and $config->mecven) {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Mecánica ventilatoria $request->mecanicaventilatoria: evaluar pase a UTI";
            event (new EvolucionEvent($evolucion));
        }

        # regla 3
        if ($request->fr > $config->valor_frecres and $config->frec_res) {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Frecuencia respiratoria mayor a $config->valor_frecres por minuto: evaluar pase a UTI";
            event (new EvolucionEvent($evolucion));
        }
        
        # regla 4
        $dia_sintomas = Carbon::createFromFormat('Y-m-d', $internacion->fIniciosintomas)->addDays(10);
        $dia_sintomas = $dia_sintomas->format('Y-m-d');
        $hoy = Carbon::now()->format('Y-m-d');
        if ($dia_sintomas == $hoy and $config->iniciosint) {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Pasaron 10 dias de inicio de sintomas: evaluar alta";
            event (new EvolucionEvent($evolucion));
        }

        # regla 5
        if ($request->sato2 < $config->valor_sato2 and $config->satuo2) {
            $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Saturación de oxígeno menor a $config->valor_sato2: evaluar oxígeno, terapia y prono";
            event (new EvolucionEvent($evolucion));
        }
        # regla 6
        elseif ($config->bajosato2) {
            $sat = $ultimaEvolucion->sato2 - $request->sato2;
            if ($sat >= $config->valor_bajoO2) {
                $evolucion->textoAlerta = "$paciente->apellido, $paciente->nombre - Saturación bajó $config->valor_bajoO2: evaluar oxígeno, terapia y prono";
                event (new EvolucionEvent($evolucion));
            }
        }

        $evolucion->save();
        return redirect()->route('verinternacion', ['id' => $request->paciente])->with('mensaje','Evolución cargada');
    }

    public function ver_evolucion($id) {
        $evolucion=App\Models\Evolucion::findOrFail($id);
        return view('evoluciones.evolucion',compact('evolucion'));
    }

}
