@extends('layout')

@section('nombrePanel')
{{ 'Camas de ' . $sala->nombre }}
@endsection

@section('tamañoPanel')
col-md-9
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
                <th scope="col" style="width:25%" class="text-primary">Camas totales: {{$total}}</th>
                <th scope="col" style="width:25%" class="text-success">Camas libres: {{$libres}}</th>
                <th scope="col" style="width:25%" class="text-danger">Camas ocupadas: {{$ocupadas}}</th></div>
            </tr>
        </thead>
    </table>
</div>

<div style="overflow-x:auto;">
    <table class="table table-hover" style="text-align: center">
        <thead>
            <tr>
                <th scope="col" style="width:15%">Cama</th>
                <th scope="col" style="width:20%">Nombre</th>
                <th scope="col" style="width:20%">Apellido</th>
                <th scope="col" style="width:20%">DNI</th>
                <th scope="col" style="width:40%">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($camas as $cama)
            <tr>
                <td scope="row">{{$cama->id}}</td>
                <td>{{!empty($cama->paciente) ? $cama->paciente->nombre:''}}</td>
                <td>{{!empty($cama->paciente) ? $cama->paciente->apellido:''}}</td>
                <td>{{!empty($cama->paciente) ? $cama->paciente->dni:''}}</td>
                @if (!empty($cama->paciente))
                    <td><a href="{{route ('verpaciente', $cama->paciente_id)}}" class="btn btn-info btn-sm">Ver</a>
                        <form action="{{route('eliminarcama',$cama)}}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td>
                @else
                <td><form action="{{route('eliminarcama',$cama)}}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    {{$camas->links()}}
@endsection