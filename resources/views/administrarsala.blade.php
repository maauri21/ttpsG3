@extends('layouts.app')

@section('nombrePanel')
{{ 'Nueva sala en ' . $salas[0]->sistema->nombre }}
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('alerta')
@if ( session('mensaje') )
    <div class="alert alert-success mb-2">{{ session('mensaje') }}</div>
@endif
@endsection

@section('content')
<form method="GET" action="{{ route('crearsala',$salas[0]->sistema->id) }}">
    @csrf
    <div class="form-group row">
        <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

        <div class="col-md-6">
            <input id="nombre" type="text" maxlength="15" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="camas" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad de camas') }}</label>

        <div class="col-md-6">
            <input id="camas" type="text" maxlength="4" class="form-control @error('camas') is-invalid @enderror" name="camas" value="{{ old('camas') }}" required autocomplete="camas" autofocus>

            @error('camas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
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

@section('content2')
<main class="mt-4">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header text-white bg-primary">{{ __('Administrar salas de ' . $salas[0]->sistema->nombre) }}</div>
                <div style="overflow-x:auto;">
                <table class="table table-hover" style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col" style="width:15%">id</th>
                            <th scope="col" style="width:35%">Nombre</th>
                            <th scope="col" style="width:40%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($salas as $item)
                        <tr>
                            <td scope="row">{{$item->id}}</td>
                            <td>{{$item->nombre}}</td>
                            <td><a href="" class="btn btn-success btn-sm">Agregar camas</a>
                                <a href="{{route ('editarsala', $item)}}" class="btn btn-warning btn-sm">Editar</a>  
                                <form action="{{route('eliminarsala', $item) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection