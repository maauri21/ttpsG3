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
        if ($total == 0) {
            $total=1;
        }
        $porcentaje = (($total-$libres)/$total)*100;
        $porcentaje = round($porcentaje, 2);

        $usuarios=App\Models\User::where('sistema_id', '=', $id)->get();

        $jefe='';
        foreach ($usuarios as $jf) {
            if($jf->hasRole('jefe')) {
                $jefe = $jf;
                break;
            }
        }

        return view('sistemas.administrarsistema',compact('salas','cantSalas','sistema','total','libres','ocupadas','porcentaje','jefe', 'usuarios'));
    }

    public function cambio_obito($id) {

        $paciente=App\Models\Paciente::findOrFail($id);
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('id', 'desc')->first();
        $sistemaActual = $internacion->sistemas()->wherePivot('fin', NULL)->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);
        $cama=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();

        $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
        $paciente->users()->detach();

        if (($sistema->nombre != 'Hotel') && ($sistema->nombre != 'Domicilio')) {
            # Dejo NULL la cama que ocupaba
            $cama->paciente_id = NULL;
            $cama->save();
        }
        else {
            $cama->delete();
        }

        # Cierro internación por obito
        $internacion=App\Models\Internacion::where('paciente_id', '=', $paciente->id)->orderBy('id', 'desc')->first();
        $internacion->fObito = date('Y-m-d');
        $internacion->save();

        return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje','Óbito registrado');

    }

    public function cambio_egreso($id, $tipo) {

        $paciente=App\Models\Paciente::findOrFail($id);
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('id', 'desc')->first();
        $sistemaActual = $internacion->sistemas()->wherePivot('fin', NULL)->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);
        $cama=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();

        $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
        $paciente->users()->detach();

        if (($sistema->nombre != 'Hotel') && ($sistema->nombre != 'Domicilio')) {
            # Dejo NULL la cama que ocupaba
            $cama->paciente_id = NULL;
            $cama->save();
        }
        else {
            $cama->delete();
        }

        # Cierro internación por egreso
        
        $internacion=App\Models\Internacion::where('paciente_id', '=', $paciente->id)->orderBy('id', 'desc')->first();
        $internacion->fAlta = date('Y-m-d');
        if ($tipo = 'C') {
            $internacion->descripcionAlta = 'Curado';
        }
        else {
            $internacion->descripcionAlta = 'Alta epidemiologica';
        }
        $internacion->save();

        return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje','Egreso registrado');

    }

    public function cambio_uti($id) {

        $paciente=App\Models\Paciente::findOrFail($id);
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('id', 'desc')->first();
        $sistemaActual = $internacion->sistemas()->wherePivot('fin', NULL)->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);

        $camas=App\Models\Cama::all();
        $libre=False;
        foreach ($camas as $cama) {
            if ($cama->sala->sistema->id == 3) {            # Me fijo si lo puedo meter en UTI
                if ($cama->paciente_id == NULL) {
                    # Pongo fecha fin en el sistema actual
                    $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                    # Va a estar en UTI
                    $internacion->sistemas()->attach(3, ['inicio' => date('Y-m-d')]);

                    # Borro medicos actuales y le asigno al jefe
                    $paciente->users()->detach();
                    $usuarios=App\Models\User::where('sistema_id', '=', 3)->get();
                    foreach ($usuarios as $jf) {
                        if($jf->hasRole('jefe')) {
                            $jefe = $jf;
                            break;
                        }
                    }
                    $paciente->users()->attach($jefe);
                    $paciente->save();

                    # Dejo NULL la cama que ocupaba
                    $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
                    $camaActual->paciente_id = NULL;
                    $camaActual->save();
                    # Agarro cama en UTI
                    $cama->paciente()->associate($paciente);
                    $cama->save();
                    $libre=True;
                    return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje','Cambio a UTI registrado');
                }
            }
        }
        if (($libre == False) && ($sistema->nombre != 'Guardia')) {                          # No hay camas en UTI, si estoy en guardia no lo muevo
            $guardiaLibre=False;
            $salaNueva=True;
            $config= App\Models\Config::findOrFail(1);
            if ($config->camasinfinitas == False) {     # Si no está configurado como infinito, busco cama en Guardia
                $camas=App\Models\Cama::all();
                foreach ($camas as $cama) {
                    if ($cama->sala->sistema->id == 1) {
                        if ($cama->paciente_id == NULL) {
                            # Pongo fecha fin en el sistema actual
                            $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                            # Va a estar en Guardia
                            $internacion->sistemas()->attach(1, ['inicio' => date('Y-m-d')]);

                            # Borro medicos actuales y le asigno al jefe
                            $paciente->users()->detach();
                            $usuarios=App\Models\User::where('sistema_id', '=', 1)->get();
                            foreach ($usuarios as $jf) {
                                if($jf->hasRole('jefe')) {
                                    $jefe = $jf;
                                    break;
                                }
                            }
                            $paciente->users()->attach($jefe);
                            $paciente->save();

                            # Dejo NULL la cama que ocupaba
                            $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
                            $camaActual->paciente_id = NULL;
                            $camaActual->save();
                            # Ocupo nueva
                            $cama->paciente()->associate($paciente);
                            $cama->save();
                            $guardiaLibre = True;
                            return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje2','No hay camas en UTI, el paciente fue llevado a Guardia');
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
                            $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                            # Va a estar en Guardia
                            $internacion->sistemas()->attach(1, ['inicio' => date('Y-m-d')]);

                            # Borro medicos actuales y le asigno al jefe
                            $paciente->users()->detach();
                            $usuarios=App\Models\User::where('sistema_id', '=', 1)->get();
                            foreach ($usuarios as $jf) {
                                if($jf->hasRole('jefe')) {
                                    $jefe = $jf;
                                    break;
                                }
                            }
                            $paciente->users()->attach($jefe);
                            $paciente->save();

                            # Dejo NULL la cama que ocupaba
                            $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
                            $camaActual->paciente_id = NULL;
                            $camaActual->save();
                            # Ocupo nueva
                            $cama->paciente()->associate($paciente);
                            $cama->save();
                            $guardiaLibre = True;
                            return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje2','No hay camas en UTI, el paciente fue llevado a Guardia');
                        }
                        # No hay libres, creo una en la sala Guardia Infinita más abajo
                    }
                }
            }
    
            if ($salaNueva) {
                $salaGInfinita= App\Models\Sala::findOrFail(1);
                # Pongo fecha fin en el sistema actual
                $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                # Va a estar en Guardia
                $internacion->sistemas()->attach(1, ['inicio' => date('Y-m-d')]);

                # Borro medicos actuales y le asigno al jefe
                $paciente->users()->detach();
                $usuarios=App\Models\User::where('sistema_id', '=', 1)->get();
                foreach ($usuarios as $jf) {
                    if($jf->hasRole('jefe')) {
                        $jefe = $jf;
                        break;
                    }
                }
                $paciente->users()->attach($jefe);
                $paciente->save();

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
                return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje2','No hay camas en UTI, el paciente fue llevado a Guardia');
            }
            if ($guardiaLibre == False) {
                return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje2','No hay camas en UTI ni en Guardia');
            }

        }
        return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje2','No hay camas en UTI');

    }

    public function cambio_pc($id) {

        $paciente=App\Models\Paciente::findOrFail($id);
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('id', 'desc')->first();
        $sistemaActual = $internacion->sistemas()->wherePivot('fin', NULL)->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);
        $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();

        $camas=App\Models\Cama::all();
        $libre=False;
        foreach ($camas as $cama) {
            if ($cama->sala->sistema->id == 2) {            # Me fijo si lo puedo meter en PC
                if ($cama->paciente_id == NULL) {
                    # Pongo fecha fin en el sistema actual
                    $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
                    # Va a estar en PC
                    $internacion->sistemas()->attach(2, ['inicio' => date('Y-m-d')]);

                    # Borro medicos actuales y le asigno al jefe
                    $paciente->users()->detach();
                    $usuarios=App\Models\User::where('sistema_id', '=', 2)->get();
                    foreach ($usuarios as $jf) {
                        if($jf->hasRole('jefe')) {
                            $jefe = $jf;
                            break;
                        }
                    }
                    $paciente->users()->attach($jefe);
                    $paciente->save();

                    if (($sistema->nombre != 'Hotel') && ($sistema->nombre != 'Domicilio')) {
                        # Dejo NULL la cama que ocupaba
                        $camaActual->paciente_id = NULL;
                        $camaActual->save();
                    }
                    else {
                        $camaActual->delete();
                    }
                    # Agarro cama en PC
                    $cama->paciente()->associate($paciente);
                    $cama->save();
                    $libre=True;
                    return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje','Cambio a Piso Covid registrado');
                }
            }
        }
        if ($libre == False) {
            return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje2','No hay camas en Piso Covid');
        }
    }

    public function cambio_hotel($id) {
        $paciente=App\Models\Paciente::findOrFail($id);
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('id', 'desc')->first();
        $sistemaActual = $internacion->sistemas()->wherePivot('fin', NULL)->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);
        $salaHotel= App\Models\Sala::findOrFail(2);
        # Pongo fecha fin en el sistema actual
        $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
        # Va a estar en Hotel
        $internacion->sistemas()->attach(4, ['inicio' => date('Y-m-d')]);

        # Borro medicos actuales y le asigno al jefe
        $paciente->users()->detach();
        $usuarios=App\Models\User::where('sistema_id', '=', 4)->get();
        foreach ($usuarios as $jf) {
            if($jf->hasRole('jefe')) {
                $jefe = $jf;
                break;
            }
        }
        $paciente->users()->attach($jefe);
        $paciente->save();

        # Dejo NULL la cama que ocupaba
        $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
        $camaActual->paciente_id = NULL;
        $camaActual->save();
        # Creo una nueva en Hotel
        $camaNueva = new App\Models\Cama;
        $camaNueva->paciente()->associate($paciente);
        $camaNueva->sala()->associate($salaHotel);
        $camaNueva->save();
        return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje','Cambio a Hotel registrado');
    }

    public function cambio_domicilio($id) {
        $paciente=App\Models\Paciente::findOrFail($id);
        $internacion=App\Models\Internacion::where('paciente_id', '=', $id)->orderBy('id', 'desc')->first();
        $sistemaActual = $internacion->sistemas()->wherePivot('fin', NULL)->first();
        $sistema=App\Models\Sistema::findOrFail($sistemaActual->id);
        $salaDomicilio= App\Models\Sala::findOrFail(3);
        # Pongo fecha fin en el sistema actual
        $internacion->sistemas()->wherePivot('fin', NULL)->updateExistingPivot($sistema, ['fin' => date('Y-m-d')]);
        # Va a estar en Domicilio
        $internacion->sistemas()->attach(5, ['inicio' => date('Y-m-d')]);

        # Borro medicos actuales y le asigno al jefe
        $paciente->users()->detach();
        $usuarios=App\Models\User::where('sistema_id', '=', 5)->get();
        foreach ($usuarios as $jf) {
            if($jf->hasRole('jefe')) {
                $jefe = $jf;
                break;
            }
        }
        $paciente->users()->attach($jefe);
        $paciente->save();

        # Dejo NULL la cama que ocupaba
        $camaActual=App\Models\Cama::where('paciente_id', '=', $paciente->id)->first();
        $camaActual->paciente_id = NULL;
        $camaActual->save();
        # Creo una nueva en Domicilio
        $camaNueva = new App\Models\Cama;
        $camaNueva->paciente()->associate($paciente);
        $camaNueva->sala()->associate($salaDomicilio);
        $camaNueva->save();
        return redirect(route('administrarsistema', ['id' => $sistema->id]))->with('mensaje','Cambio a Domicilio registrado');
    }
}