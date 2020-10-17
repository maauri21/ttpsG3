<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class SistemaController extends Controller
{
    public function administrarsistema($id) {
        $salas=App\Models\Sala::where('sistema_id', '=', $id)->get();
        $cantSalas=App\Models\Sala::where('sistema_id', '=', $id)->count();
        $camas=App\Models\Cama::all();
        $sistema=App\Models\Sistema::findOrFail($id);

        # Cuento las del sistema donde estoy
        $total=0;
        $libres=0;
        $ocupadas=0;
        $array = array();
        foreach ($camas as $cama) {
            if ($cama->sala->sistema->id == $id) {
                $total++;
                array_push($array, $cama->id);
                if ($cama->paciente_id == NULL) {
                    $libres++;
                }
                else {
                    $ocupadas++;
                }

            }
        }
        $camasSistema = App\Models\Cama::findMany($array);
        return view('sistemas.administrarsistema',compact('salas','cantSalas','camasSistema','sistema','total','libres','ocupadas'));
    }
}
