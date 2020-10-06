@extends('layouts.app')

@section('nombrePanel')
Resetear contraseña
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
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mail') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Enviar link') }}
            </button>
        </div>
    </div>
</form>
@endsection
