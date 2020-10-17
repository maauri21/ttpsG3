<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class SalaController extends Controller
{

    public function administrarsala($id) {
        $sala=App\Models\Sala::findOrFail($id);
        $camas=App\Models\Cama::where('sala_id', '=', $id)->paginate(10);
        $total=App\Models\Cama::where('sala_id', '=', $id)->count();
        $libres=App\Models\Cama::where('sala_id', '=', $id)->where('paciente_id', '=', NULL)->count();
        $ocupadas=App\Models\Cama::where('sala_id', '=', $id)->where('paciente_id', '!=', NULL)->count();
        return view('salas.administrarsala',compact('sala','camas','total','libres','ocupadas'));
    }

    public function crearsala(Request $request, $idSistema) {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:25'],
            'camas' => ['required', 'digits_between:1,2'],
        ]);
        $sistema=App\Models\Sistema::findOrFail($idSistema);

        $salaNueva = new App\Models\Sala;
        $salaNueva->nombre = $request->nombre;
        $salaNueva->sistema()->associate($sistema);
        $salaNueva->save();

        # Agrego la cantidad de camas que puse en el formulario para esa sala
        for ($i = 1; $i <= $request->camas; $i++) {
            $camaNueva = new App\Models\Cama;
            $camaNueva->sala()->associate($salaNueva);
            $camaNueva->save();
        }

        return back()->with('mensaje', 'Sala agregada');
    }

    public function eliminarsala($id){
        $salaEliminar=App\Models\Sala::findOrFail($id);
        $camas=App\Models\Cama::where('sala_id', '=', $id)->get();
        foreach ($camas as $cama) {
            if ($cama->paciente_id != NULL) {
                return back()->with('mensaje2','No se puede borrar una sala que tiene camas ocupadas');
             }
        }
        $salaEliminar->delete();
        return back()->with('mensaje','Sala eliminada');
    }

    public function editarsala ($id){
        $sala=App\Models\Sala::findOrFail($id);
        return view ('salas.editarsala',compact ('sala'));
    } 
    
    public function actualizarsala(Request $request, $id){
        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:25'],
            'camas' => ['nullable', 'digits_between:1,2'],
        ]);
        $salaEditar=App\Models\Sala::findOrFail($id);
        $salaEditar->nombre = $request->nombre;

        # Agrego la cantidad de camas que puse en el formulario para esa sala
        for ($i = 1; $i <= $request->camas; $i++) {
            $camaNueva = new App\Models\Cama;
            $camaNueva->sala()->associate($salaEditar);
            $camaNueva->save();
        }

        $salaEditar->save();
        $url = route('administrarsistema', ['id' => $salaEditar->sistema_id]);
        return redirect($url)->with('mensaje','Sala editada');
    }
}
