@extends('layout')

@section('nombrePanel')
Administrar personal
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
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Legajo</th>
            <th scope="col">Usuario</th>
            <th scope="col">Rol</th>
            <th scope="col">Sistema</th>
            <th scope="col" style="width:25%">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $item)
        <tr>
            <td scope="row">{{$item->id}}</td>
            <td>
                    {{$item->nombre}}
                </a>
            </td>
            <td>{{$item->apellido}}</td>
            <td>{{$item->legajo}}</td>
            <td>{{$item->nombreUsuario}}</td>
            <td>{{ucfirst($item->getRoleNames()->first())}}</td>
            @if (!empty($item->sistema))
                <td>{{$item->sistema->nombre}}</td>
            @else
                <td>-</td>
            @endif
            <td>
                @if ($item->hasRole('medico'))
                    <a href="{{route ('cambiar_sistema', $item)}}" class="btn btn-info btn-sm">Cambiar sistema</a>  
                    <a href="{{route ('editarpersonal', $item)}}" class="btn btn-warning btn-sm">Editar</a>  
                    <form action="{{route('eliminarusuario', $item) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm ('¿Está seguro?')">Eliminar</button>
                    </form>
                @else
                    <a href="{{route ('editarpersonal', $item)}}" class="btn btn-warning btn-sm">Editar</a>  
                    <form action="{{route('eliminarusuario', $item) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm ('¿Está seguro?')">Eliminar</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$usuarios->links()}}
</div>
@endsection