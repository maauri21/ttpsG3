@extends('layout')

@section('nombrePanel')
Administrar pacientes
@endsection

@section('tamañoPanel')
col-md-13
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
            <th scope="col">DNI</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Fecha de nacimiento</th>
            <th scope="col">Obra Social</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pacientes as $item)
        <tr>
            <td>{{$item->dni}}</a></td>
            <td>{{ucfirst($item->nombre)}}</td>
            <td>{{ucfirst($item->apellido)}}</td>
            <td>{{$item->telefono}}</td>
            <td>{{date("d/m/Y",strtotime($item->fnac))}}</td>
            @if (!empty($item->obrasocial))
                <td>{{$item->obrasocial}}</td>
            @else
                <td>-</td>
            @endif
            <td>
                <a href="{{route('internaciones',$item)}}" class="btn btn-info btn-sm">Internaciones</a>  
                <a href="{{route('editarpaciente',$item)}}" class="btn btn-warning btn-sm">Editar</a>  
                <form action="{{route('eliminarpaciente',$item)}}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm ('¿Está seguro?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
{{$pacientes->links()}}
@endsection