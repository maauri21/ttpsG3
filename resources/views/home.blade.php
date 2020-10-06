@extends('layouts.app')

@section('nombrePanel')
Panel
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('alerta')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
@endsection

@section('content')
    @can('cargarPaciente')
    <h2>Cosa de medico</h2>
    @endcan
    <div class="form-group row"><a href="{{route('cargarpaciente')}}" class="btn btn-primary ml-3">Cargar paciente</a></div>
@endsection
