@extends('layout')

@section('nombrePanel')
Asignar médico
@endsection

@section('tamañoPanel')
col-md-11
@endsection

@section('alerta')
@if ( session('mensaje') )
    <div class="alert alert-success mb-2">{{ session('mensaje') }}</div>
@endif

@if ( session('mensaje2') )
    <div class="alert alert-danger mb-2">{{ session('mensaje2') }}</div>
@endif

@endsection

@section('content')
<div style="overflow-x:auto;">
<table class="table table-hover" style="text-align: center">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Legajo</th>
            <th scope="col">Usuario</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($medicos as $item)
        <tr>
            <td>{{$item->nombre}}</td>
            <td>{{$item->apellido}}</td>
            <td>{{$item->legajo}}</td>
            <td>{{$item->nombreUsuario}}</td>
            <td>
                <a href="{{route('asignarmedico2',['idP'=>$id, 'idM'=>$item->id])}}" class="btn btn-primary btn-sm">Asignar</a>  
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{{route ('verinternacion', $id)}}" class="btn btn-primary">Volver a la internación</a>
</div>
@endsection