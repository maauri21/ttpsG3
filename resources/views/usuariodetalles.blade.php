@extends('layouts.app')

@section('content')

<h1>Detalle Del Usuario</h1>
<h4>Nombre:{{$usuario->nombre}}</h4>
<h4>Apellido:{{$usuario->apellido}}</h4>
<h4>Legajo:{{$usuario->legajo}}</h4>
<h4>Email:{{$usuario->email}}</h4>
<h4>Nobmre de Usuario:{{$usuario->nombreUsuario}}</h4>
<h4>Contraseña:{{$usuario->password}}</h4>

@endsection