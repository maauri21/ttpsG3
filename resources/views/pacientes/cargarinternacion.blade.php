@extends('layout')

@section('nombrePanel')
Registrar internación
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')

<form method="POST" action="{{ route('cargarinternacion2', $id) }}">
    @csrf
    <div class="form-group row">
        <label for="fIniciosintomas" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de inicio de síntomas') }}</label>

        <div class="col-md-6">
            <input id="fIniciosintomas" type="date" class="form-control @error('fIniciosintomas') is-invalid @enderror" name="fIniciosintomas" value="{{ old('fIniciosintomas') }}" required autocomplete="fIniciosintomas">

            @error('fIniciosintomas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="fDiagnosticocovid" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de diagnóstico COVID') }}</label>

        <div class="col-md-6">
            <input id="fDiagnosticocovid" type="date" class="form-control @error('fDiagnosticocovid') is-invalid @enderror" name="fDiagnosticocovid" value="{{ old('fDiagnosticocovid') }}" required autocomplete="fDiagnosticocovid">

            @error('fDiagnosticocovid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

        <div class="col-md-6">
            <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion">

            @error('descripcion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Registrar') }}
            </button>
        </div>
    </div>
</form>
@endsection
