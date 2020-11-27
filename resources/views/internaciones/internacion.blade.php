@extends('layout')

@section('nombrePanel')
Evoluciones
@endsection

@section('tamañoPanel')
col-md-8
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
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evoluciones as $evolucion)
            <tr>
                <td>{{date("d/m/Y",strtotime($evolucion->fecha))}}</td>
                <td>{{substr($evolucion->hora, 0, -3)}}</td>
                <td><a href="{{route('ver_evolucion',$evolucion->id)}}" class="btn btn-info btn-sm">Ver</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$evoluciones->links()}}
@endsection