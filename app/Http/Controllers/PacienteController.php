<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PacienteController extends Controller
{
    public function cargarpaciente() {
        return view('pacientes.cargarpaciente');
    }

    public function cargarpaciente2(Request $request) {
        $request->validate([
            'dni' => 'required | numeric | digits_between:7,9'
        ]);

        # Antes de cargarlo compruebo las camas, tengo que buscar cama de guardia con paciente null
        $libres=False;
        $config= App\Models\Config::findOrFail(1);
        if ($config->camasinfinitas == False) {
            $camas=App\Models\Cama::all();
            foreach ($camas as $cama) {
                if ($cama->sala->sistema->id == 1) {
                    if ($cama->paciente_id == NULL) {
                        $libres=True;
                        break;
                    }
                }
            }
        }
        else {  # Camas infinitas
            $libres=True;
        }
        if (!$libres) {
            return redirect('home')->with('mensaje2','No hay camas disponibles');
        }

        $dni=$request->dni;
        $paciente=App\Models\Paciente::where('dni', '=', $dni)->first();
        if ($paciente == '') {
            return view('pacientes.cargarpaciente2',compact('dni'));
        }
        else {
            return redirect()->route('cargarinternacion', ['id' => $paciente->id]);
        }
    }

    public function cargarpaciente3(Request $request) {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:15'],
            'apellido' => ['required', 'string', 'min:2', 'max:20'],
            'direccion' => ['required', 'string', 'min:2', 'max:20'],
            'telefono' => ['required', 'numeric', 'digits_between:5,15'],
            'fnac' => ['required', 'date', 'after_or_equal:01/01/1920', 'before_or_equal:today'],
            'email' => ['required', 'string', 'email', 'max:30'],
            'obrasocial' => ['nullable', 'string', 'max:15'],
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
        $pacienteNuevo->email = $request->email;
        $pacienteNuevo->obrasocial = $request->obrasocial;
        $pacienteNuevo->antecedentes = $request->antecedentes;
        $pacienteNuevo->contacto()->associate($contactoNuevo);
        $pacienteNuevo->save();

        #$pacienteNuevo->sistemas()->attach(1);     #Le asigno guardia
        $pacienteNuevo->sistemas()->attach(1, ['inicio' => date('Y-m-d')]);     #Ademas de asignarle guardia, Agrego fecha en la tabla intermedia
        return redirect()->route('cargarinternacion', ['id' => $pacienteNuevo->id]);
    }

    public function administrarpacientes() {
        $pacientes= App\Models\Paciente::paginate(10);
        return view('pacientes.administrarpacientes', compact ('pacientes'));
    }

    public function eliminarpaciente($id) {
        $paciente=App\Models\Paciente::findOrFail($id);
        if ($paciente->cama != NULL) {
            return back()->with('mensaje2','No se puede borrar un paciente en cama');
        }
        $paciente->delete();
        return back()->with('mensaje','Paciente eliminado');
    }

    public function editarpaciente ($id){
        $paciente=App\Models\Paciente::findOrFail($id);
        return view ('pacientes.editarpaciente',compact ('paciente'));
    } 

    public function actualizarpaciente(Request $request, $id){
        $paciente=App\Models\Paciente::findOrFail($id);
        $request->validate([
            'dni' => 'required|numeric|digits_between:7,9|unique:pacientes,dni,'.$paciente->id.',id',
            'nombre' => ['required', 'string', 'min:2', 'max:15'],
            'apellido' => ['required', 'string', 'min:2', 'max:20'],
            'direccion' => ['required', 'string', 'min:2', 'max:20'],
            'telefono' => ['required', 'numeric', 'digits_between:5,15'],
            'fnac' => ['required', 'date', 'after_or_equal:01/01/1920', 'before_or_equal:today'],
            'email' => ['required', 'string', 'email', 'max:30'],
            'obrasocial' => ['nullable', 'string', 'max:15'],
        ]);
        $paciente->dni = $request->dni;
        $paciente->nombre = $request->nombre;
        $paciente->apellido= $request->apellido;
        $paciente->direccion= $request->direccion;
        $paciente->telefono= $request->telefono;
        $paciente->fnac= $request->fnac;
        $paciente->email= $request->email;
        $paciente->obrasocial= $request->obrasocial;
        $paciente->save();
        return redirect('pacientes')->with('mensaje','Paciente editado');
    }

}
