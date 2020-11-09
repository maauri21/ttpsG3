<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvolucionController extends Controller
{
    public function cargar_evolucion() {
        return view('evoluciones.cargarevolucion');
    }

    public function cargar_evolucion2(Request $request) {
        $request->validate([
            'temperatura' => 'required | numeric | between:0,9.9',
            'tasistolica' => 'required | numeric | digits_between:1,3',
            'tadiastolica' => 'required | numeric | digits_between:1,3',
            'fc' => 'required | numeric | digits_between:1,3',
            'fr' => 'required | numeric | digits_between:1,3',
            'canulanasal' => 'numeric | between:1,6',
            'mascarares' => 'numeric | between:1,100',
            'sato2' => 'numeric | between:0,100',
            'valorpafi' => 'numeric',
            'hto' => 'numeric',
        ]);
        echo $request->temperatura;
    }
}
