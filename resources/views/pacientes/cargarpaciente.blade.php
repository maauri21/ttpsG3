@extends('layout')

@section('nombrePanel')
Cargar paciente
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')
<form method="GET" action="{{ route('cargarpaciente2') }}">
    @csrf
    <div class="form-group row">
        <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>
        <div class="col-md-6">
            <input id="dni" type="text" maxlength="9" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni" autofocus>

            @error('dni')
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