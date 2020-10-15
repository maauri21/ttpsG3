<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PagesController extends Controller
{

    public function cargarpaciente() {
        return view('pacientes.cargarpaciente');
    }

    public function cargarpaciente2(Request $request) {
        $request->validate([
            'dni' => 'required | numeric | digits_between:7,9'
        ]);
        $dni=$request->dni;
        $paciente=App\Models\Paciente::where('dni', '=', $dni)->get();
        if ($paciente == '[]') {
            return view('pacientes.cargarpaciente2',compact('dni'));
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
    }

    public function administrarsistema(Request $request, $id) {
        $salas=App\Models\Sala::where('sistema_id', '=', $id)->get();
        $camas=App\Models\Cama::all();
        $sistema=App\Models\Sistema::findOrFail($id);

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
        return view('sistemas.administrarsistema',compact('salas','sistema','total','libres','ocupadas'));
    }

    public function crearsala(Request $request, $idSistema) {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:25'],
            'camas' => ['required', 'numeric', 'digits_between:1,4'],
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

    #Empieza a tirar el capitani lbm

    public function listarpersonal() {
        $usuarios= App\Models\User::all();
        return view('personal.listarpersonal', compact ('usuarios'));
    }

    public function editarpersonal ($id){
        $usuario= App\Models\User::findOrFail($id);
        return view ('personal.editarpersonal',compact ('usuario'));

    }

    public function actualizarusuario (Request $request, $id){
        $usuarioauxiliar= App\Models\User::findOrFail($id);
        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:15'],
            'apellido' => ['required', 'string', 'min:2', 'max:20'],
            'legajo' => 'nullable|string|max:10|unique:users,legajo,'.$usuarioauxiliar->id.',id',
            'email' => 'required|email|max:30|unique:users,email,'.$usuarioauxiliar->id.',id',
            'nombreUsuario' => 'required|string|max:15|unique:users,nombreUsuario,'.$usuarioauxiliar->id.',id',
                        
        ]);
        $usuarioauxiliar->nombre= $request->nombre;
        $usuarioauxiliar->apellido= $request->apellido;
        $usuarioauxiliar->legajo= $request->legajo;
        $usuarioauxiliar->email= $request->email;
        $usuarioauxiliar->nombreUsuario= $request->nombreUsuario;
        $usuarioauxiliar->save();
        return redirect('listarpersonal')->with('mensaje','Usuario editado');
    }


    public function eliminarusuario($id){
        $usuarioEliminar=App\Models\User::findOrFail($id);
        $usuarioEliminar->delete();
        return back()->with('mensaje','Usuario eliminado');
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
        return view ('sala.editarsala',compact ('sala'));
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