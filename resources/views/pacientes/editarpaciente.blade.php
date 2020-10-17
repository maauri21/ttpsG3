@extends('layout')

@section('nombrePanel')
{{ 'Editar ' . $paciente->dni }}
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')
<form action="{{ route('actualizarpaciente', $paciente->id) }}" method="POST">
    @method('PUT')
    @csrf
    
    <div class="form-group row">
        <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>
        <div class="col-md-6">
            <input id="dni" type="text" maxlength="9" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $paciente->dni }}" spellcheck="false" required autocomplete="dni" autofocus>
    
            @error('dni')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
        <div class="col-md-6">
            <input id="nombre" type="text" maxlength="15" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $paciente->nombre }}" spellcheck="false" required autocomplete="nombre">

            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
        <div class="col-md-6">
            <input id="apellido" type="text" maxlength="20" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ $paciente->apellido }}" spellcheck="false" required autocomplete="apellido">
    
            @error('apellido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>
        <div class="col-md-6">
            <input id="direccion" type="text" maxlength="20" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $paciente->direccion }}" spellcheck="false" required autocomplete="direccion">
    
            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>
        <div class="col-md-6">
            <input id="telefono" type="text" maxlength="15" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $paciente->telefono }}" spellcheck="false" required autocomplete="telefono">
    
            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="fnac" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de nacimiento') }}</label>
        <div class="col-md-6">
            <input id="fnac" type="date" class="form-control @error('fnac') is-invalid @enderror" name="fnac" value="{{ $paciente->fnac }}" spellcheck="false" required autocomplete="fnac">
    
            @error('fnac')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" maxlength="30" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $paciente->email }}" spellcheck="false" required autocomplete="email">
    
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="obrasocial" class="col-md-4 col-form-label text-md-right">{{ __('Obra social') }}</label>
        <div class="col-md-6">
            <input id="obrasocial" type="text" maxlength="15" class="form-control @error('obrasocial') is-invalid @enderror" name="obrasocial" value="{{ $paciente->obrasocial }}" spellcheck="false" autocomplete="obrasocial">
    
            @error('obrasocial')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Editar') }}
            </button>
        </div>
    </div>
</form>
@endsection