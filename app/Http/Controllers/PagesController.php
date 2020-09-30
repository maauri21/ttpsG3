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

    public function administrarsistema() {
        return view('administrarsistema');
    }

    public function administrarsala(Request $request) {
        $salas=App\Models\Sala::where('sistema_id', '=', $request->sistema)->get();
        return view('administrarsala',compact('salas'));
    }

    public function crearsala(Request $request, $idSistema) {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:15'],
            'camas' => ['required', 'numeric', 'digits_between:1,4'],
        ]);
        $sistema=App\Models\Sistema::findOrFail($idSistema);

        $salaNueva = new App\Models\Sala;
        $salaNueva->nombre = $request->nombre;
        $salaNueva->sistema()->associate($sistema);
        $salaNueva->save();
        return back()->with('mensaje', 'Sala agregada');

        # Agregar cantidad de camas en tabla Cama, associate con $salaNueva
    }

    #Empieza a tirar el capitani lbm

    public function listarusuarios() {
        $usuarios= App\Models\User::all();
        return view('listarusuarios', compact ('usuarios'));
    }

    public function verdetalle($id){                         # se que no me lo pediste pero creo a futuro capaz lo vamos a poder implementar con los pacientes para ver las historias y esas cosas
        $usuario= App\Models\User::findOrFail($id);
        return view ('usuariodetalles',compact ('usuario'));
    }

    public function editorusuario ($id){
        $usuario= App\Models\User::findOrFail($id);
        return view ('modificarusuario',compact ('usuario'));

    }

    public function actualizarusuario (Request $request, $id){
        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:15'],
            'apellido' => ['required','string', 'min:2', 'max:15'],
                        
        ]);                                                             #intente validar todos los campos pero solo agarra nombre, dsp por apellido, dni y los demas no entra
        $usuarioauxiliar= App\Models\User::findOrFail($id);
        $usuarioauxiliar->nombre= $request->nombre;
        $usuarioauxiliar->apellido= $request->apellido;
        $usuarioauxiliar->legajo= $request->legajo;
        $usuarioauxiliar->email= $request->email;
        $usuarioauxiliar->nombreUsuario= $request->nombreUsuario;
        $usuarioauxiliar->password= bcrypt($request->password);
        $usuarioauxiliar->save();
        return back()->with('mensaje','Usuario Actualizado!');  #mando 'mensaje' para el manejo de sesiones, chequearlo, pero anda bien el localhost
    }


    public function eliminarusuario($id){
        $usuarioEliminar=App\Models\User::findOrFail($id);
        $usuarioEliminar->delete();
        return back()->with('mensaje','Usuario Eliminado!'); #mando 'mensaje' para el manejo de sesiones, chequearlo, pero anda bien el localhost

    }

    public function eliminarsala($id){
        $salaEliminar=App\Models\Sala::findOrFail($id);
        $salaEliminar->delete();
        return back()->with('mensaje','Sala Eliminada!'); #mando 'mensaje' para el manejo de sesiones, chequearlo, pero anda bien el localhost

    }
    public function editarsala ($id){
        $sala= App\Models\Sala::findOrFail($id);
        return view ('modificarsala',compact ('sala'));

    } 
    
    public function actualizarsala(Request $request, $id){
        $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:15'],          #mismo caso que actualizar usuario, aca solo chequeo nombre, pero si tuviera que chequear idSistema pasaria lo mismo que actualizarUsuario
           
         ]);
                    
        $usuarioauxiliar= App\Models\Sala::findOrFail($id);
        $usuarioauxiliar->id= $request->id;
        $usuarioauxiliar->nombre= $request->nombre;
        $usuarioauxiliar->sistema_id= $request->sistema_id;
         $usuarioauxiliar->save();
        return back()->with('mensaje','Sala Actualizada!');
    }
}

#App\Usuario::all();


