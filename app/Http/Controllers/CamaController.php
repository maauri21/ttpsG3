<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class CamaController extends Controller
{
    public function camasinfinitas(Request $request) {

        $config= App\Models\Config::findOrFail(1);

        if ($request->cinfinitas == 'Si') {
            $config->camasinfinitas = True;
            $config->save();
        }
        else {
            $config->camasinfinitas = False;
            $config->save();
        }
        return redirect()->route('home')->with('mensaje', 'Camas infinitas modificado');
    }

    public function eliminarcama($id) {
        $cama=App\Models\Cama::findOrFail($id);
        if ($cama->paciente_id != NULL) {
            return back()->with('mensaje2','No se puede eliminar una cama ocupada');
        }
        $cama->delete();
        return back()->with('mensaje','Cama eliminada');
    }
}
