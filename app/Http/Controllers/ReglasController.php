<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class ReglasController extends Controller
{
    public function actualizar_reglas(Request $request){
        $request->validate([
            'sato2' => ['required', 'numeric', 'between:0,100'],
            'valor_frecres' => ['required', 'numeric', 'between:0,100'],
        ]);
        $config= App\Models\Config::findOrFail(1);
        $config->valor_sato2 = $request->sato2;
        $config->valor_frecres = $request->valor_frecres;
        $config->valor_bajoO2 = $request->valor_bajoso2;
        $config->somnolencia = ($request->somnolencia) ? 1 : 0;
        $config->mecven = ($request->mecven) ? 1 : 0;
        $config->frec_res = ($request->frec_res) ? 1 : 0;
        $config->iniciosint = ($request->iniciosint) ? 1 : 0;
        $config->satuo2 = ($request->satuo2) ? 1 : 0;
        $config->bajosato2 = ($request->bajosato2) ? 1 : 0;

        $config->save();
        return redirect()->route('home')->with('mensaje', 'Reglas modificadas');
    }
}
