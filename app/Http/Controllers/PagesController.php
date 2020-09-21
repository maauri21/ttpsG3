<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PagesController extends Controller
{

    public function cargarpaciente() {
        return view('cargarpaciente');
    }

    public function cargarpaciente2(Request $request) {
        $request->validate([
            'dni' => 'required | numeric | digits_between:7,9'
        ]);
        $dni=$request->dni;
        $paciente=App\Models\Paciente::where('dni', '=', $dni)->get();
        if ($paciente == '[]') {
            return view('cargarpaciente2',compact('dni'));
        }
        else {
            echo "carga3";
        }
    }

    public function cargarpaciente3(Request $request) {
        $request->validate([
            'dni' => ['required', 'numeric', 'digits_between:7,9', 'unique:pacientes'],
            'nombre' => ['required', 'string', 'min:2', 'max:15'],
            'apellido' => ['required', 'string', 'min:2', 'max:20'],
            'direccion' => ['required', 'string', 'min:2', 'max:20'],
            'telefono' => ['required', 'numeric', 'digits_between:5,15'],
            'fnac' => ['required', 'date', 'after_or_equal:01/01/1920', 'before_or_equal:today'],
            'nombreContacto' => ['nullable', 'string', 'min:2', 'max:15'],
            'apellidoContacto' => ['nullable', 'string', 'min:2', 'max:20'],
            'relacion' => ['nullable', 'string', 'min:2', 'max:15'],
            'telefonoContacto' => ['nullable', 'numeric', 'digits_between:5,15'],
        ]);
        
        $contactoNuevo = new App\Models\Contacto;
        if(!empty($request->telefonoContacto)) {
            $contactoNuevo->nombre = $request->nombreContacto;
            $contactoNuevo->apellido = $request->apellidoContacto;
            $contactoNuevo->relacion = $request->relacion;
            $contactoNuevo->telefono = $request->telefonoContacto;
            $contactoNuevo->save();
        }

        $pacienteNuevo = new App\Models\Paciente;
        $pacienteNuevo->dni = $request->dni;
        $pacienteNuevo->nombre = $request->nombre;
        $pacienteNuevo->apellido = $request->apellido;
        $pacienteNuevo->direccion = $request->direccion;
        $pacienteNuevo->telefono = $request->telefono;
        $pacienteNuevo->fnac = $request->fnac;
        $pacienteNuevo->contacto_id = $contactoNuevo->id;
        $pacienteNuevo->save();

    }

}