@extends('layouts.app')

@section('content')

    <h1>Editar Sala {{$sala->nombre}}</h1>

    @if (session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}

        </div>
    @endif

    <form action="{{ route('actualizarsala', $sala->id) }}" method="POST">
     @method('PUT')
        @csrf

        @error('nombre')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            El nombre es requerido
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror 
        @if ($errors->has('descripcion'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                La descripción es requerida
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        
        <input type="text" name="nombre" placeholder="Nombre de la sala" class="form-control mb-2" value="{{ $sala->nombre }}">
        <input type="text" name="sistema_id" placeholder="Id en el sistema" class="form-control mb-2" value="{{ $sala->sistema_id }}">
        
        <button class="btn btn-warning btn-block" type="submit">Aceptar</button>
    </form>

@endsection