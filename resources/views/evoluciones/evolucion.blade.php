@extends('layout')

@section('nombrePanel')
{{ 'Ver evolución' }}
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <!-- Sistema respiratorio -->

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

                                @if (!empty($evolucion->o2suplementario))

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Cánula nasal') }}</label>
                                        <div class="col-md-6">
                                            <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->canulanasal) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Máscara con reservorio') }}</label>
                                        <div class="col-md-6">
                                            <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->mascarares) }}">
                                        </div>
                                    </div>

                                @endif

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Saturación O2') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->sato2) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('PaFi') }}</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->pafi)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                    </div>
                                </div>

                                @if (!empty($evolucion->pafi))

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Valor PaFi') }}</label>
                                        <div class="col-md-6">
                                            <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->valorpafi) }}">
                                        </div>
                                    </div>

                                @endif

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Prono vigil') }}</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->pronovigil)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Tos') }}</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->tos)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Disnea') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->disnea) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Sin síntomas respiratorios') }}</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->desaresp)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <!-- Otros síntomas -->

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
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Somnolencia') }}</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->somnolencia)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Anosmia') }}</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->aosmia)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Disgeusia') }}</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->disgeusia)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <!-- Estudios realizados hoy -->

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
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Rx Tx') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->rxtx)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                </div>
                            </div>

                            @if (!empty($evolucion->rxtx))
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->tiporxtx) }}">
                                    </div>
                                </div>
                            @endif

                            @if ($evolucion->tiporxtx == 'patologico')
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->descripcionrx) }}">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('TAC de tórax') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->tactorax)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                </div>
                            </div>

                            @if (!empty($evolucion->tactorax))
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->tipotactorax) }}">
                                    </div>
                                </div>
                            @endif

                            @if ($evolucion->tipotactorax == 'patologico')
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->descripciontactorax) }}">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('ECG') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->ecg)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                </div>
                            </div>

                            @if (!empty($evolucion->ecg))
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->tipoecg) }}">
                                    </div>
                                </div>
                            @endif

                            @if ($evolucion->tipoecg == 'patologico')
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->descripcionecg) }}">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('PCR Covid') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->pcr)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                </div>
                            </div>

                            @if (!empty($evolucion->pcr))
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->tipopcr) }}">
                                    </div>
                                </div>
                            @endif

                            @if ($evolucion->tipopcr == 'patologico')
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->descripcionpcr) }}">
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <!-- Observación -->

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

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->descripcionobs) }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <!-- UTI -->

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
                                <label class="col-md-4 col-form-label text-md-right">{{ __('ARM') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->arm)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                </div>
                            </div>

                            @if (!empty($evolucion->arm))
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->descripcionArm) }}">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Traqueostomia') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->traqueostomia)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Vasopresores') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" disabled="disabled" data-toggle="toggle" @if(!empty($evolucion->vasopresores)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" ">
                                </div>
                            </div>

                            @if (!empty($evolucion->vasopresores))
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control" value="{{ ucfirst($evolucion->descripcionVasop) }}">
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection