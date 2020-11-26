@extends('layout')

@section('nombrePanel')
{{ 'Ver evolución ' . $evolucion->id }}
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
        <div class="col-md-6">
            <input type="text" readonly class="form-control" value="{{ date("d/m/Y",strtotime($evolucion->fecha)) }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>
        <div class="col-md-6">
            <input type="text" readonly class="form-control" value="{{ substr($evolucion->hora, 0, -3) }}">
        </div>
    </div>

    <!-- Signos vitales -->

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('Temperatura') }}</label>
        <div class="col-md-6">
            <input type="text" readonly class="form-control" value="{{ $evolucion->temperatura }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('TA Sistólica') }}</label>
        <div class="col-md-6">
            <input type="text" readonly class="form-control" value="{{ $evolucion->tasistolica }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('TA Diastólica') }}</label>
        <div class="col-md-6">
            <input type="text" readonly class="form-control" value="{{ $evolucion->tadiastolica }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('Frecuencia cardíaca') }}</label>
        <div class="col-md-6">
            <input type="text" readonly class="form-control" value="{{ $evolucion->fc }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('Frecuencia respiratoria') }}</label>
        <div class="col-md-6">
            <input type="text" readonly class="form-control" value="{{ $evolucion->fr }}">
        </div>
    </div>

    <!-- Sistema respiratorio -->

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('Mecánica ventilatoria') }}</label>
        <div class="col-md-6">
            <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->mecanicaventilatoria) }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __('O2 suplementario') }}</label>
        <div class="col-md-6">
            <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->o2suplementario)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
        </div>
    </div>

@endsection