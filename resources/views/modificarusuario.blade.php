@extends('layouts.app')

@section('content')

    <h1>Editar Usuario {{$usuario->nombreUsuario}}</h1>

    @if (session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}

        </div>
    @endif

    <form action="{{ route('actualizarusuario', $usuario->id) }}" method="POST">
     @method('PUT')
     @csrf

     @error('nombre')
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
         El nombre es requerido
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>
     @enderror 
     @if ($errors->has('descripcion'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">      
             La descripción es requerida
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
     @endif

                    
        <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2" value="{{ $usuario->nombre }}">
        <input type="text" name="apellido" placeholder="Apellido" class="form-control mb-2" value="{{ $usuario->apellido }}">
        <input type="text" name="legajo" placeholder="Legajo" class="form-control mb-2" value="{{ $usuario->legajo }}">
        <input type="text" name="email" placeholder="Email" class="form-control mb-2" value="{{ $usuario->email }}">
        <input type="text" name="nombreUsuario" placeholder="Nombre de Usuario" class="form-control mb-2" value="{{ $usuario->nombreUsuario }}">
        <input type="text" name="password" placeholder="Password" class="form-control mb-2" value="{{ $usuario->password }}">
        <button class="btn btn-warning btn-block" type="submit">Aceptar</button>
    </form>

@endsection




