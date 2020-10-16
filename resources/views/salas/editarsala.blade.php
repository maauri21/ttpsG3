@extends('layout')

@section('nombrePanel')
{{ 'Editar ' . $sala->nombre }}
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')
<form action="{{ route('actualizarsala', $sala->id) }}" method="POST">
    @method('PUT')
    @csrf
    
    <div class="form-group row">
        <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
        <div class="col-md-6">
            <input id="nombre" type="text" maxlength="25" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $sala->nombre }}" spellcheck="false" required autocomplete="nombre" autofocus>

            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="camas" class="col-md-4 col-form-label text-md-right">{{ __('Agregar camas') }}</label>
        <div class="col-md-6">
            <input id="camas" type="text" maxlength="9" class="form-control @error('camas') is-invalid @enderror" name="camas" value="{{ old('camas') }}" autocomplete="camas">
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
                {{ __('Editar') }}
            </button>
        </div>
    </div>
</form>
@endsection