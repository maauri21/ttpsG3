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
}
