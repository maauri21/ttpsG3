@extends('layout')

@section('nombrePanel')
Cargar evolución
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')

<form method="POST" action="{{ route('cargar_evolucion2') }}">
    @csrf
<main class="mt-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-secondary">
                    <h6 class="card-header bg-secondary">
                        <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example" id="heading-example" class="collapsed d-block text-white">
                            <i class="text-white fa fa-chevron-down pull-right"></i>
                            {{ __('Signos vitales') }}
                        </a>
                    </h6>
                    <div id="collapse-example" class="collapse" aria-labelledby="heading-example">
                        <div class="card-body">

                            <input id="paciente" type="hidden" class="form-control" name="paciente" value="{{$id}}">

                            <div class="form-group row">
                                <label for="temperatura" class="col-md-4 col-form-label text-md-right">{{ __('Temperatura') }}</label>
                                <div class="col-md-6">
                                    <input id="temperatura" type="text" maxlength="3" class="form-control @error('temperatura') is-invalid @enderror" name="temperatura" value="{{ old('temperatura') }}" required autocomplete="temperatura">
                                    @error('temperatura')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tasistolica" class="col-md-4 col-form-label text-md-right">{{ __('TA Sistólica') }}</label>
                                <div class="col-md-6">
                                    <input id="tasistolica" type="text" maxlength="3" class="form-control @error('tasistolica') is-invalid @enderror" name="tasistolica" value="{{ old('tasistolica') }}" required autocomplete="tasistolica" autofocus>
                                    @error('tasistolica')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tadiastolica" class="col-md-4 col-form-label text-md-right">{{ __('TA Diastólica') }}</label>
                                <div class="col-md-6">
                                    <input id="tadiastolica" type="text" maxlength="3" class="form-control @error('tadiastolica') is-invalid @enderror" name="tadiastolica" value="{{ old('tadiastolica') }}" required autocomplete="tadiastolica" autofocus>
                                    @error('tadiastolica')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fc" class="col-md-4 col-form-label text-md-right">{{ __('FC') }}</label>
                                <div class="col-md-6">
                                    <input id="fc" type="text" maxlength="3" class="form-control @error('fc') is-invalid @enderror" name="fc" value="{{ old('fc') }}" required autocomplete="fc" autofocus>
                                    @error('fc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fr" class="col-md-4 col-form-label text-md-right">{{ __('FR') }}</label>
                                <div class="col-md-6">
                                    <input id="fr" type="text" maxlength="3" class="form-control @error('fr') is-invalid @enderror" name="fr" value="{{ old('fr') }}" required autocomplete="fr" autofocus>
                                    @error('fr')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="mt-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-secondary">
                    <h6 class="card-header bg-secondary">
                        <a data-toggle="collapse" href="#collapse-example2" aria-expanded="true" aria-controls="collapse-example2" id="heading-example" class="collapsed d-block text-white">
                            <i class="text-white fa fa-chevron-down pull-right"></i>
                            {{ __('Sistema respiratorio') }}
                        </a>
                    </h6>
                    <div id="collapse-example2" class="collapse" aria-labelledby="heading-example">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="mecanicaventilatoria" class="col-md-4 col-form-label text-md-right">{{ __('Mecánica ventilatoria') }}</label>
                        
                                <div class="col-md-6">
                                    <select id="mecanicaventilatoria" name="mecanicaventilatoria" class="form-control">
                                        <option value="buena" {{ old('mecanicaventilatoria') == 'buena' ? 'selected="selected"' : '' }}>Buena</option>
                                        <option value="regular" {{ old('mecanicaventilatoria') == 'regular' ? 'selected="selected"' : '' }}>Regular</option>
                                        <option value="mala" {{ old('mecanicaventilatoria') == 'mala' ? 'selected="selected"' : '' }}>Mala</option>
                                        </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="o2suplementario" class="col-md-4 col-form-label text-md-right">{{ __('O2 suplementario') }}</label>
                                <div class="col-md-6">
                                    <input id="o2suplementario" type="checkbox" data-toggle="toggle" @if(old('o2suplementario')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="o2suplementario">
                                </div>
                            </div>

                            <div id="canulanasal" style="display: none" class="form-group row">
                                <label for="canulanasal" class="col-md-4 col-form-label text-md-right">{{ __('Cánula nasal') }}</label>
                                <div class="col-md-6">
                                    <input id="canulanasal" type="text" maxlength="3" class="form-control @error('canulanasal') is-invalid @enderror" name="canulanasal" value="{{ old('canulanasal') }}" autocomplete="canulanasal" autofocus>
                                    @error('canulanasal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="mascarares" style="display: none" class="form-group row">
                                <label for="mascarares" class="col-md-4 col-form-label text-md-right">{{ __('Máscara con reservorio') }}</label>
                                <div class="col-md-6">
                                    <input id="mascarares" type="text" maxlength="4" class="form-control @error('mascarares') is-invalid @enderror" name="mascarares" value="{{ old('mascarares') }}" autocomplete="mascarares" autofocus>
                                    @error('mascarares')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="sato2" class="form-group row">
                                <label for="sato2" class="col-md-4 col-form-label text-md-right">{{ __('Saturación O2') }}</label>
                                <div class="col-md-6">
                                    <input id="sato2" type="text" maxlength="3" class="form-control @error('sato2') is-invalid @enderror" name="sato2" value="{{ old('sato2') }}" required autocomplete="sato2" autofocus>
                                    @error('sato2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pafi" class="col-md-4 col-form-label text-md-right">{{ __('PaFi') }}</label>
                                <div class="col-md-6">
                                    <input id="pafi" type="checkbox" data-toggle="toggle" @if(old('pafi')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="pafi">
                                </div>
                            </div>

                            <div id="valorpafi" style="display: none" class="form-group row">
                                <label for="valorpafi" class="col-md-4 col-form-label text-md-right">{{ __('Valor PaFi') }}</label>
                                <div class="col-md-6">
                                    <input id="valorpafi" type="text" maxlength="4" class="form-control @error('valorpafi') is-invalid @enderror" name="valorpafi" value="{{ old('valorpafi') }}" autocomplete="valorpafi" autofocus>
                                    @error('valorpafi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pronovigil" class="col-md-4 col-form-label text-md-right">{{ __('Prono vigil') }}</label>
                                <div class="col-md-6">
                                    <input id="pronovigil" type="checkbox" data-toggle="toggle" @if(old('pronovigil')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="pronovigil">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tos" class="col-md-4 col-form-label text-md-right">{{ __('Tos') }}</label>
                                <div class="col-md-6">
                                    <input id="tos" type="checkbox" data-toggle="toggle" @if(old('tos')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="tos">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="disnea" class="col-md-4 col-form-label text-md-right">{{ __('Disnea') }}</label>
                            
                                <div class="col-md-6">
                                    <select id="disnea" name="disnea" class="form-control">
                                        <option value="0" {{ old('disnea') == '0' ? 'selected="selected"' : '' }}>0</option>
                                        <option value="1" {{ old('disnea') == '1' ? 'selected="selected"' : '' }}>1</option>
                                        <option value="2" {{ old('disnea') == '2' ? 'selected="selected"' : '' }}>2</option>
                                        <option value="3" {{ old('disnea') == '3' ? 'selected="selected"' : '' }}>3</option>
                                        <option value="4" {{ old('disnea') == '4' ? 'selected="selected"' : '' }}>4</option>
                                        </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="desaresp" class="col-md-4 col-form-label text-md-right">{{ __('Sin síntomas respiratorios') }}</label>
                                <div class="col-md-6">
                                    <input id="desaresp" type="checkbox" data-toggle="toggle" @if(old('desaresp')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="desaresp">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="mt-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-secondary">
                    <h6 class="card-header bg-secondary">
                        <a data-toggle="collapse" href="#collapse-example3" aria-expanded="true" aria-controls="collapse-example3" id="heading-example" class="collapsed d-block text-white">
                            <i class="text-white fa fa-chevron-down pull-right"></i>
                            {{ __('Otros síntomas') }}
                        </a>
                    </h6>
                    <div id="collapse-example3" class="collapse" aria-labelledby="heading-example">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="somnolencia" class="col-md-4 col-form-label text-md-right">{{ __('Somnolencia ') }}</label>
                                <div class="col-md-6">
                                    <input id="somnolencia" type="checkbox" data-toggle="toggle" @if(old('somnolencia')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="somnolencia">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="anosmia" class="col-md-4 col-form-label text-md-right">{{ __('Anosmia ') }}</label>
                                <div class="col-md-6">
                                    <input id="anosmia" type="checkbox" data-toggle="toggle" @if(old('anosmia')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="anosmia">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="disgeusia" class="col-md-4 col-form-label text-md-right">{{ __('Disgeusia') }}</label>
                                <div class="col-md-6">
                                    <input id="disgeusia" type="checkbox" data-toggle="toggle" @if(old('disgeusia')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="disgeusia">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="mt-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-secondary">
                    <h6 class="card-header bg-secondary">
                        <a data-toggle="collapse" href="#collapse-example4" aria-expanded="true" aria-controls="collapse-example4" id="heading-example" class="collapsed d-block text-white">
                            <i class="text-white fa fa-chevron-down pull-right"></i>
                            {{ __('Estudios realizados hoy') }}
                        </a>
                    </h6>
                    <div id="collapse-example4" class="collapse" aria-labelledby="heading-example">
                        <div class="card-body">
                            
                            <div class="form-group row">
                                <label for="rxtx" class="col-md-4 col-form-label text-md-right">{{ __('Rx Tx') }}</label>
                                <div class="col-md-6">
                                    <input id="rxtx" type="checkbox" data-toggle="toggle" @if(old('rxtx')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="rxtx">
                                </div>
                            </div>

                            <div id="tiporxtx" style="display: none" class="form-group row">
                                <label for="tiporxtx" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            
                                <div class="col-md-6">
                                    <select id="tiporxtx" name="tiporxtx" class="form-control">
                                        <option value="normal" {{ old('tiporxtx') == 'normal' ? 'selected="selected"' : '' }}>Normal</option>
                                        <option value="patologico" {{ old('tiporxtx') == 'patologico' ? 'selected="selected"' : '' }}>Patológico</option>
                                    </select>
                                </div>
                            </div>

                            <div id="descripcionrx" style="display: none" class="form-group row">
                                <label for="descripcionrx" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <div class="col-md-6">
                                    <input id="descripcionrx" type="text" maxlength="100" class="form-control @error('descripcionrx') is-invalid @enderror" name="descripcionrx" value="{{ old('descripcionrx') }}" autocomplete="descripcionrx" autofocus>
                                    @error('descripcionrx')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tactorax" class="col-md-4 col-form-label text-md-right">{{ __('TAC de tórax') }}</label>
                                <div class="col-md-6">
                                    <input id="tactorax" type="checkbox" data-toggle="toggle" @if(old('tactorax')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="tactorax">
                                </div>
                            </div>
                            
                            <div id="tipotactorax" style="display: none" class="form-group row">
                                <label for="tipotactorax" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            
                                <div class="col-md-6">
                                    <select id="tipotactorax" name="tipotactorax" class="form-control">
                                        <option value="normal" {{ old('tipotactorax') == 'normal' ? 'selected="selected"' : '' }}>Normal</option>
                                        <option value="patologico" {{ old('tipotactorax') == 'patologico' ? 'selected="selected"' : '' }}>Patológico</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="descripciontactorax" style="display: none" class="form-group row">
                                <label for="descripciontactorax" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <div class="col-md-6">
                                    <input id="descripciontactorax" type="text" maxlength="100" class="form-control @error('descripciontactorax') is-invalid @enderror" name="descripciontactorax" value="{{ old('descripciontactorax') }}" autocomplete="descripciontactorax" autofocus>
                                    @error('descripciontactorax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ecg" class="col-md-4 col-form-label text-md-right">{{ __('ECG') }}</label>
                                <div class="col-md-6">
                                    <input id="ecg" type="checkbox" data-toggle="toggle" @if(old('ecg')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="ecg">
                                </div>
                            </div>
                            
                            <div id="tipoecg" style="display: none" class="form-group row">
                                <label for="tipoecg" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            
                                <div class="col-md-6">
                                    <select id="tipoecg" name="tipoecg" class="form-control">
                                        <option value="normal" {{ old('tipoecg') == 'normal' ? 'selected="selected"' : '' }}>Normal</option>
                                        <option value="patologico" {{ old('tipoecg') == 'patologico' ? 'selected="selected"' : '' }}>Patológico</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="descripcionecg" style="display: none" class="form-group row">
                                <label for="descripcionecg" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <div class="col-md-6">
                                    <input id="descripcionecg" type="text" maxlength="100" class="form-control @error('descripcionecg') is-invalid @enderror" name="descripcionecg" value="{{ old('descripcionecg') }}" autocomplete="descripcionecg" autofocus>
                                    @error('descripcionecg')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pcr" class="col-md-4 col-form-label text-md-right">{{ __('PCR Covid') }}</label>
                                <div class="col-md-6">
                                    <input id="pcr" type="checkbox" data-toggle="toggle" @if(old('pcr')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="pcr">
                                </div>
                            </div>
                            
                            <div id="tipopcr" style="display: none" class="form-group row">
                                <label for="tipopcr" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            
                                <div class="col-md-6">
                                    <select id="tipopcr" name="tipopcr" class="form-control">
                                        <option value="normal" {{ old('tipopcr') == 'normal' ? 'selected="selected"' : '' }}>Normal</option>
                                        <option value="patologico" {{ old('tipopcr') == 'patologico' ? 'selected="selected"' : '' }}>Patológico</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="descripcionpcr" style="display: none" class="form-group row">
                                <label for="descripcionpcr" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <div class="col-md-6">
                                    <input id="descripcionpcr" type="text" maxlength="100" class="form-control @error('descripcionpcr') is-invalid @enderror" name="descripcionpcr" value="{{ old('descripcionpcr') }}" autocomplete="descripcionpcr" autofocus>
                                    @error('descripcionpcr')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="mt-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-secondary">
                    <h6 class="card-header bg-secondary">
                        <a data-toggle="collapse" href="#collapse-example6" aria-expanded="true" aria-controls="collapse-example6" id="heading-example" class="collapsed d-block text-white">
                            <i class="text-white fa fa-chevron-down pull-right"></i>
                            {{ __('Observación') }}
                        </a>
                    </h6>
                    <div id="collapse-example6" class="collapse" aria-labelledby="heading-example">
                        <div class="card-body">
                            <div id="descripcionobs" class="form-group row">
                                <label for="descripcionobs" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <div class="col-md-6">
                                    <input id="descripcionobs" type="text" maxlength="100" class="form-control @error('descripcionobs') is-invalid @enderror" name="descripcionobs" value="{{ old('descripcionobs') }}" required autocomplete="descripcionobs" autofocus>
                                    @error('descripcionobs')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@if($sistemaActual->nombre == 'Unidad Terapia Intensiva')
<main class="mt-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-secondary">
                    <h6 class="card-header bg-secondary">
                        <a data-toggle="collapse" href="#collapse-example7" aria-expanded="true" aria-controls="collapse-example7" id="heading-example" class="collapsed d-block text-white">
                            <i class="text-white fa fa-chevron-down pull-right"></i>
                            {{ __('UTI') }}
                        </a>
                    </h6>
                    <div id="collapse-example7" class="collapse" aria-labelledby="heading-example">
                        <div class="card-body"> 
                            <div class="form-group row">
                                <label for="arm" class="col-md-4 col-form-label text-md-right">{{ __('ARM') }}</label>
                                <div class="col-md-6">
                                    <input id="arm" type="checkbox" data-toggle="toggle" @if(old('arm')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="arm">
                                </div>
                            </div>

                            <div id="descripcionArm" style="display: none" class="form-group row">
                                <label for="descripcionArm" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <div class="col-md-6">
                                    <input id="descripcionArm" type="text" maxlength="5" class="form-control @error('descripcionArm') is-invalid @enderror" name="descripcionArm" value="{{ old('descripcionArm') }}" autocomplete="descripcionArm" autofocus>
                                    @error('descripcionArm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="traqueostomia" class="col-md-4 col-form-label text-md-right">{{ __('Traqueostomia') }}</label>
                                <div class="col-md-6">
                                    <input id="traqueostomia" type="checkbox" data-toggle="toggle" @if(old('traqueostomia')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="traqueostomia">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="vasopresores" class="col-md-4 col-form-label text-md-right">{{ __('Vasopresores') }}</label>
                                <div class="col-md-6">
                                    <input id="vasopresores" type="checkbox" data-toggle="toggle" @if(old('vasopresores')) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="vasopresores">
                                </div>
                            </div>

                            <div id="descripcionVasop" style="display: none" class="form-group row">
                                <label for="descripcionVasop" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <div class="col-md-6">
                                    <input id="descripcionVasop" type="text" maxlength="5" class="form-control @error('descripcionVasop') is-invalid @enderror" name="descripcionVasop" value="{{ old('descripcionVasop') }}" autocomplete="descripcionVasop" autofocus>
                                    @error('descripcionVasop')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</main>
@endif

<div class="form-group row mt-3 mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Aceptar') }}
        </button>
    </div>
</div>
</form>

<script src="{{ asset('cargarevolucionn.js') }}"></script>

@endsection