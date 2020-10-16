@extends('layout')

@section('nombrePanel')
Panel
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
    @can('cargarPaciente')
        <div class="form-group row"><a href="{{route('cargarpaciente')}}" class="btn btn-primary ml-3">Cargar paciente</a></div>
    @endcan
    <form method="POST" action="{{ route('camasinfinitas') }}">
        @csrf
        <div class="form-group row">
            <label for="cinfinitas" class="col-md-4 col-form-label text-md-right">{{ __('Camas Infinitas') }}</label>
    
            <div class="col-md-6">
                <input id="cinfinitas" type="checkbox" data-toggle="toggle" @if(!empty($config->camasinfinitas)) checked @endif data-onstyle="success" data-offstyle="danger" data-on="Si" data-off="No" name="cinfinitas" value=Si>
    
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Aceptar') }}
                </button>
            </div>
        </div>
    </form>

@endsection
