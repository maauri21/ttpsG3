@extends('layout')

@section('nombrePanel')
Sistemas y Evoluciones
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
                <th scope="col"></th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evo_y_cambios as $ec)
            <tr>
                @if(!empty($ec->sistema_id))
                    <td class="text-primary"><b>{{$ec->sistema_id}}</b></td>
                    <td>{{date("d/m/Y H:i",strtotime($ec->fecha))}}</td>
                    <td>-</td>
                @else
                    <td class="text-success"><b>{{'Evolución'}}</b></td>
                    <td>{{date("d/m/Y H:i",strtotime($ec->fecha))}}</td>
                    <td><a href="{{route('ver_evolucion',$ec->id)}}" class="btn btn-info btn-sm">Ver</a></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{route ('internaciones', $paciente->id)}}" class="btn btn-primary">Volver</a>
@endsection