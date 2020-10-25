<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class SistemaController extends Controller
{
    public function administrarsistema($id) {
        $salas=App\Models\Sala::where('sistema_id', '=', $id)->paginate(8);
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

        $url = route('administrarsistema', ['id' => $sistema->id]);
        return redirect($url)->with('mensaje','Óbito registrado');

    }

    public function cambio_egreso($id, $tipo) {

        $paciente=App\Models\Paciente::findOrFail($id);
        $sistemaActual = $paciente->sistemas()->latest('id')->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);

        # Pongo fecha fin en el sistema actual
        $paciente->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);

        # Dejo NULL la cama que ocupaba
        $cama=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
        $cama->paciente_id = NULL;
        $cama->save();

        # Cierro internación por egreso
        $internacion=App\Models\Internacion::where('paciente_id', '=', $paciente->id)->first();
        $internacion->fAlta = date('Y-m-d');
        if ($tipo = 'C') {
            $internacion->descripcionAlta = 'Curado';
        }
        else {
            $internacion->descripcionAlta = 'Alta epidemiologica';
        }
        $internacion->save();

        $url = route('administrarsistema', ['id' => $sistema->id]);
        return redirect($url)->with('mensaje','Egreso registrado');

    }

    public function cambio_uti($id) {

        $paciente=App\Models\Paciente::findOrFail($id);
        $sistemaActual = $paciente->sistemas()->latest('id')->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);

        $camas=App\Models\Cama::all();
        $libre=False;
        foreach ($camas as $cama) {
            if ($cama->sala->sistema->id == 3) {            # Me fijo si lo puedo meter en UTI
                if ($cama->paciente_id == NULL) {
                    # Pongo fecha fin en el sistema actual
                    $paciente->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                    # Va a estar en UTI
                    $paciente->sistemas()->attach(3, ['inicio' => date('Y-m-d')]);
                    # Dejo NULL la cama que ocupaba
                    $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
                    $camaActual->paciente_id = NULL;
                    $camaActual->save();
                    # Agarro cama en UTI
                    $cama->paciente()->associate($paciente);
                    $cama->save();
                    $libre=True;
                    $url = route('administrarsistema', ['id' => $sistema->id]);
                    return redirect($url)->with('mensaje','Cambio a UTI registrado');
                }
            }
        }
        if ($libre == False) {                          # No hay camas en UTI
            $guardiaLibre=False;
            $salaNueva=True;
            $config= App\Models\Config::findOrFail(1);
            if ($config->camasinfinitas == False) {     # Si no está configurado como infinito, busco cama en Guardia
                $camas=App\Models\Cama::all();
                foreach ($camas as $cama) {
                    if ($cama->sala->sistema->id == 1) {
                        if ($cama->paciente_id == NULL) {
                            # Pongo fecha fin en el sistema actual
                            $paciente->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                            # Va a estar en Guardia
                            $paciente->sistemas()->attach(1, ['inicio' => date('Y-m-d')]);
                            # Dejo NULL la cama que ocupaba
                            $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
                            $camaActual->paciente_id = NULL;
                            $camaActual->save();
                            # Ocupo nueva
                            $cama->paciente()->associate($paciente);
                            $cama->save();
                            $guardiaLibre = True;
                            $url = route('administrarsistema', ['id' => $sistema->id]);
                            return redirect($url)->with('mensaje2','No hay camas en UTI, el paciente fue llevado a Guardia');
                            break;
                        }
                    }
                }
            }
            else {          # Camas infinitas activadas, primero me fijo si hay alguna libre
                $camas=App\Models\Cama::all();
                foreach ($camas as $cama) {
                    if ($cama->sala->sistema->id == 1) {
                        if ($cama->paciente_id == NULL) {
                            # Pongo fecha fin en el sistema actual
                            $paciente->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                            # Va a estar en Guardia
                            $paciente->sistemas()->attach(1, ['inicio' => date('Y-m-d')]);
                            # Dejo NULL la cama que ocupaba
                            $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
                            $camaActual->paciente_id = NULL;
                            $camaActual->save();
                            # Ocupo nueva
                            $cama->paciente()->associate($paciente);
                            $cama->save();
                            $guardiaLibre = True; 
                            $url = route('administrarsistema', ['id' => $sistema->id]);
                            return redirect($url)->with('mensaje2','No hay camas en UTI, el paciente fue llevado a Guardia');
                        }
                        # No hay libres, creo una en la sala Guardia Infinita más abajo
                    }
                }
            }
    
            if ($salaNueva) {
                $salaGInfinita= App\Models\Sala::findOrFail(1);
                # Pongo fecha fin en el sistema actual
                $paciente->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                # Va a estar en Guardia
                $paciente->sistemas()->attach(1, ['inicio' => date('Y-m-d')]);
                # Dejo NULL la cama que ocupaba
                $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
                $camaActual->paciente_id = NULL;
                $camaActual->save();
                # Ocupo nueva
                $camaNueva = new App\Models\Cama;
                $camaNueva->paciente()->associate($paciente);
                $camaNueva->sala()->associate($salaGInfinita);
                $camaNueva->save();
                $guardiaLibre = True;
                $url = route('administrarsistema', ['id' => $sistema->id]);
                return redirect($url)->with('mensaje2','No hay camas en UTI, el paciente fue llevado a Guardia');
            }
            if ($guardiaLibre == False) {
                $url = route('administrarsistema', ['id' => $sistema->id]);
                return redirect($url)->with('mensaje2','No hay camas en UTI ni en Guardia');
            }

        }

    }

}
