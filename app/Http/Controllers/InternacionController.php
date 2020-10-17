<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

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
}
