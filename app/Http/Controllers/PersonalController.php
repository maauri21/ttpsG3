<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PersonalController extends Controller
{
    public function administrarpersonal() {
        $usuarios= App\Models\User::paginate(10);
        return view('personal.administrarpersonal', compact ('usuarios'));
    }

    public function editarpersonal ($id){
        $usuario= App\Models\User::findOrFail($id);
        return view ('personal.editarpersonal',compact ('usuario'));

    }

    public function actualizarpersonal (Request $request, $id){
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
        return redirect('personal')->with('mensaje','Usuario editado');
    }

    public function eliminarusuario($id){
        $usuarioEliminar=App\Models\User::findOrFail($id);

        if($usuarioEliminar->hasRole('jefe')) {
            return back()->with('mensaje2','No se puede eliminar un jefe');
        }
        elseif ($usuarioEliminar->hasRole('administrador')) {
            return back()->with('mensaje2','No se puede eliminar un administrador');
        }
        $usuarioEliminar->delete();
        return back()->with('mensaje','Usuario eliminado');
    }

    public function cambiar_sistema($id) {
        $usuario= App\Models\User::findOrFail($id);
        return view('personal.cambiarsistema', compact ('usuario'));
    }

    public function cambiar_sistema2(Request $request, $id) {
        $usuario= App\Models\User::findOrFail($id);
        # Marco como leidas las notificaciones del sistema anterior
        $usuario->unreadNotifications->markAsRead();
        # Borro los pacientes asignados
        $usuario->pacientes()->detach();
        $usuario->sistema_id= $request->sistema;
        $usuario->save();
        return redirect('personal')->with('mensaje','Cambio de sistema registrado');
    }
}
