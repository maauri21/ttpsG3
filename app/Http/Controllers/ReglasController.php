<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class ReglasController extends Controller
{
    public function actualizar_reglas(Request $request){
        $request->validate([
            'sato2' => ['required', 'numeric', 'between:0,100'],
        ]);
        $config= App\Models\Config::findOrFail(1);
        $config->sat_o2 = $request->sato2;
        $config->save();
        return redirect()->route('home')->with('mensaje', 'Reglas modificadas');
    }
}
