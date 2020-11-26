@extends('layout')

@section('nombrePanel')
Panel - (rool admin)
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('alerta')

@if ( session('mensaje') )
    <div class="alert alert-success mb-2">{{ session('mensaje') }}</div>
@endif

@if ( session('mensaje2') )
    <div class="alert alert-danger mb-2">{{ session('mensaje2') }}</div>
@endif

@endsection

@section('content')
    @can('cargarPaciente')
        <div class="form-group row"><a href="{{route('cargarpaciente')}}" class="btn btn-primary ml-3">Cargar paciente</a></div>
    @endcan
    <form method="POST" action="{{ route('camasinfinitas') }}">
        @csrf
        <div class="form-group row">
            <label for="cinfinitas" class="col-md-4 col-form-label text-md-right">{{ __('Camas Infinitas') }}</label>
            <div class="col-md-6">
                <input id="cinfinitas" type="checkbox" data-toggle="toggle" @if(!empty($config->camasinfinitas)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="cinfinitas">
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Aceptar') }}
                </button>
                <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

@endsection

@section('content2')
<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">Panel Reglas - ROOL OPERADOR</div>
                        <div class="card-body">
                            <form action="{{ route('actualizar_reglas') }}" method="POST">
                                @method('PUT')
                                @csrf

                                <div class="form-group row">
                                    <label for="somnolencia" class="col-md-4 col-form-label text-md-right">{{ __('Somnolencia') }}</label>
                                    <div class="col-md-6">
                                        <input id="somnolencia" type="checkbox" data-toggle="toggle" @if(!empty($config->somnolencia)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="somnolencia">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mecven" class="col-md-4 col-form-label text-md-right">{{ __('Mecánica ventilatoria') }}</label>
                                    <div class="col-md-6">
                                        <input id="mecven" type="checkbox" data-toggle="toggle" @if(!empty($config->mecven)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="mecven">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="valor_frecres" class="col-md-4 col-form-label text-md-right">{{ __('Frecuencia respiratoria') }}</label>
                                    <div class="col-xs-2">
                                        <input id="valor_frecres" type="text" maxlength="3" class="form-control @error('valor_frecres') is-invalid @enderror" name="valor_frecres" value="{{ $config->valor_frecres }}" spellcheck="false" required autocomplete="valor_frecres">
                                        @error('valor_frecres')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row ml-1">
                                        <div class="col-md-6">
                                            <input id="frec_res" type="checkbox" data-toggle="toggle" @if(!empty($config->frec_res)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="frec_res">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="iniciosint" class="col-md-4 col-form-label text-md-right">{{ __('Inicio de síntomas') }}</label>
                                    <div class="col-md-6">
                                        <input id="iniciosint" type="checkbox" data-toggle="toggle" @if(!empty($config->iniciosint)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="iniciosint">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="sato2" class="col-md-4 col-form-label text-md-right">{{ __('Saturación O2') }}</label>
                                    <div class="col-xs-2">
                                        <input id="sato2" type="text" maxlength="3" class="form-control @error('sato2') is-invalid @enderror" name="sato2" value="{{ $config->valor_sato2 }}" spellcheck="false" required autocomplete="sato2">
                                        @error('sato2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row ml-1">
                                        <div class="col-md-6">
                                            <input id="satuo2" type="checkbox" data-toggle="toggle" @if(!empty($config->satuo2)) checked @endif data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" " name="satuo2">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Aceptar') }}
                                        </button>
                                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">Panel Jefe - (ROOL JEFE)</div>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table table-hover" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sistema</th>
                                            <th scope="col" class="text-primary">Camas totales</th>
                                            <th scope="col" class="text-success">Camas libres</th>
                                            <th scope="col" class="text-danger">Camas ocupadas</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{'Guardia'}}</td>
                                            <td>{{$array[0]}}</td>
                                            <td>{{$array[1]}}</td>
                                            <td>{{$array[2]}}</td>
                                            <td><a href="{{ route('administrarsistema', ['id' => 1]) }}" class="btn btn-info btn-sm">Ver</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{'Piso Covid'}}</td>
                                            <td>{{$array[3]}}</td>
                                            <td>{{$array[4]}}</td>
                                            <td>{{$array[5]}}</td>
                                            <td><a href="{{ route('administrarsistema', ['id' => 2]) }}" class="btn btn-info btn-sm">Ver</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{'UTI'}}</td>
                                            <td>{{$array[6]}}</td>
                                            <td>{{$array[7]}}</td>
                                            <td>{{$array[8]}}</td>
                                            <td><a href="{{ route('administrarsistema', ['id' => 3]) }}" class="btn btn-info btn-sm">Ver</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{'Hotel'}}</td>
                                            <td>{{$array[9]}}</td>
                                            <td>{{$array[10]}}</td>
                                            <td>{{$array[11]}}</td>
                                            <td><a href="{{ route('administrarsistema', ['id' => 4]) }}" class="btn btn-info btn-sm">Ver</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{'Domicilio'}}</td>
                                            <td>{{$array[12]}}</td>
                                            <td>{{$array[13]}}</td>
                                            <td>{{$array[14]}}</td>
                                            <td><a href="{{ route('administrarsistema', ['id' => 5]) }}" class="btn btn-info btn-sm">Ver</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>

@can('panelJefe', 'panelMedico')
<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">ROOL MEDICO/JEFE</div>
                        <div class="card-body">
                            <a href="{{ route('administrarsistema', ['id' => auth()->user()->sistema->id]) }}" class="btn btn-info">Ir a mi sistema</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endcan

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">Mis pacientes - ROOL MEDICO/JEFE</div>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">DNI</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellido</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usuario->pacientes as $up)
                                        <tr>
                                            <td>{{$up->dni}}</td>
                                            <td>{{$up->nombre}}</td>
                                            <td>{{$up->apellido}}</td>
                                            <td><a href="{{route ('verinternacion', $up->id)}}" class="btn btn-info btn-sm">Ver</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection