@extends('layout')

@section('nombrePanel')
{{ 'Cambiar de sistema a ' . $usuario->nombreUsuario }}
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')
<form method="POST" spellcheck="false" action="{{ route('cambiar_sistema2', $usuario->id) }}">
    @method('PUT')
    @csrf

<div id="sistema" class="form-group row">
    <label for="sistema" class="col-md-4 col-form-label text-md-right">{{ __('Sistema') }}</label>

    <div class="col-md-6">
        <select id="sistema" name="sistema" class="form-control">
            <option value="1" @if($usuario->sistema->nombre == 'Guardia') disabled hidden @endif>Guardia</option>
            <option value="2" @if($usuario->sistema->nombre == 'Piso Covid') disabled hidden @endif>Piso Covid</option>
            <option value="3" @if($usuario->sistema->nombre == 'Unidad Terapia Intensiva') disabled hidden @endif>UTI</option>
            <option value="4" @if($usuario->sistema->nombre == 'Hotel') disabled hidden @endif>Hotel</option>
            <option value="5" @if($usuario->sistema->nombre == 'Domicilio') disabled hidden @endif>Domicilio</option>
            </select>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Aceptar') }}
        </button>
        <a href="{{url()->previous()}}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

</form>
@endsection



