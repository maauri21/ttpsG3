@extends('layout')

@section('nombrePanel')
Internaciones de {{$paciente->nombre}}
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
            <th scope="col">Inicio de síntomas</th>
            <th scope="col">Diagnóstico de COVID</th>
            <th scope="col">Internación</th>
            <th scope="col">Óbito</th>
            <th scope="col">Alta</th>
            <th scope="col" style="width:25%">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($internaciones as $item)
        <tr>
            <td>{{date("d/m/Y",strtotime($item->fIniciosintomas))}}</td>
            <td>{{date("d/m/Y",strtotime($item->fDiagnosticocovid))}}</td>
            <td>{{date("d/m/Y",strtotime($item->fInternacion))}}</td>
            <td>{{!empty($item->fObito) ? date("d/m/Y",strtotime($item->fObito)):''}}</td>
            <td>{{!empty($item->fAlta) ? date("d/m/Y",strtotime($item->fAlta)):''}}</td>
            <td>
                @if(!empty($item->fAlta) || !empty($item->fObito))
                    <a href="{{route ('internacion', $item)}}" class="btn btn-info btn-sm">Ver</a>  
                @else
                    <a href="{{route ('verinternacion', $paciente)}}" class="btn btn-success btn-sm">Ver Actual</a>  
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{{route ('administrarpacientes')}}" class="btn btn-primary">Volver</a>
</div>
@endsection