<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class InternacionController extends Controller
{
    public function cargarinternacion($id) {
        $paciente=App\Models\Paciente::findOrFail($id);
        return view ('pacientes.cargarinternacion',compact ('id','paciente'));
    }

    public function cargarinternacion2(Request $request, $id) {
        $request->validate([
            'fIniciosintomas' => ['required', 'date', 'after_or_equal:01/01/2020', 'before_or_equal:today'],
            'fDiagnosticocovid' => ['required', 'date', 'after_or_equal:01/01/2020', 'before_or_equal:today'],
            'descripcion' => ['required', 'string', 'min:2'],
        ]);

        $paciente= App\Models\Paciente::findOrFail($id);
        $internacion = new App\Models\Internacion;
        $internacion->fIniciosintomas = $request->fIniciosintomas;
        $internacion->fDiagnosticocovid = $request->fDiagnosticocovid;
        $internacion->descripcion = $request->descripcion;
        $internacion->fInternacion = date('Y-m-d');
        $internacion->paciente()->associate($paciente);
        $internacion->save();
        
        $internacion->sistemas()->attach(1, ['inicio' => date('Y-m-d')]);     #Ademas de asignarle guardia, Agrego fecha en la tabla intermedia

        $usuarios=App\Models\User::where('sistema_id', '=', 1)->get();      # Para buscar al jefe de guardia
        foreach ($usuarios as $jf) {
            if($jf->hasRole('jefe')) {
                $jefe = $jf;
                break;
            }
        }
        $paciente->users()->attach($jefe);

        $salaNueva=True;
        $config= App\Models\Config::findOrFail(1);
        if ($config->camasinfinitas == False) {
            $camas=App\Models\Cama::all();
            foreach ($camas as $cama) {
                if ($cama->sala->sistema->id == 1) {
                    if ($cama->paciente_id == NULL) {
                        $cama->paciente()->associate($paciente);
                        $cama->save();
                        return redirect('home')->with('mensaje','Internación registrada');
                        break;
                    }
                }
            }
        }
        else {  # Camas infinitas activadas, primero me fijo si hay alguna libre
            $camas=App\Models\Cama::all();
            foreach ($camas as $cama) {
                if ($cama->sala->sistema->id == 1) {
                    if ($cama->paciente_id == NULL) {
                        $cama->paciente()->associate($paciente);
                        $cama->save();
                        return redirect('home')->with('mensaje','Internación registrada');
                    }
                    # No hay libres, creo una en la sala Guardia Infinita más abajo
                }
            }
        }

        if ($salaNueva) {
            $camaNueva = new App\Models\Cama;
            $salaGInfinita= App\Models\Sala::findOrFail(1);
            $camaNueva->paciente()->associate($paciente);
            $camaNueva->sala()->associate($salaGInfinita);
            $camaNueva->save();
            return redirect('home')->with('mensaje','Internación registrada');
        }
    }

    public function internacion_actual($id) {
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('id', 'desc')->first();
        $sistema = $internacion->sistemas()->wherePivot('fin', NULL)->first();
        $paciente=App\Models\Paciente::findOrFail($id);

        $evoluciones = DB::table('evolucions')->where('internacion_id', $internacion->id)->get();
        $cambios_sistema = DB::table('internacion_sistema')->where('internacion_id', $internacion->id)->get();

        $cambios_sistema->each(function(&$sist) {
            if ($sist->sistema_id == 1) {
                $sist->sistema_id = 'Guardia';
            }
            elseif ($sist->sistema_id == 2) {
                $sist->sistema_id = 'Piso Covid';
            }
            elseif ($sist->sistema_id == 3) {
                $sist->sistema_id = 'Unidad Terapia Intensiva';
            }
            elseif ($sist->sistema_id == 4) {
                $sist->sistema_id = 'Hotel';
            }
            elseif ($sist->sistema_id == 5) {
                $sist->sistema_id = 'Domicilio';
            }
        });

        $evo_y_cambios = new Collection;
        $evo_y_cambios = $evo_y_cambios->merge($evoluciones)->merge($cambios_sistema)->sortBy('fechon');

        return view('internaciones.internacion_actual',compact('paciente','sistema', 'evo_y_cambios'));
    }

    public function internaciones($id) {
        $paciente= App\Models\Paciente::findOrFail($id);
        $internaciones=App\Models\Internacion::where('paciente_id', '=', $id)->get();
        return view ('internaciones.internaciones',compact ('internaciones','paciente'));
    }

    public function internacion($id) {
        $array = array();
        $internacion=App\Models\Internacion::findOrFail($id);
        $evoluciones=App\Models\Evolucion::where('internacion_id', '=', $id)->paginate(10);
        $paciente= App\Models\Paciente::findOrFail($internacion->paciente_id);
        foreach ($internacion->sistemas as $PC) {
            $sistema=App\Models\Sistema::findOrFail($PC->pivot->sistema_id);
            array_push($array, $sistema->nombre);
        }
        return view ('internaciones.internacion',compact ('evoluciones','paciente', 'internacion', 'array'));
    }

}
