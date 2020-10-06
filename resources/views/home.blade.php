@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header text-white bg-primary">{{ __('Panel') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('cargarPaciente')
                    <h2>Cosa de medico</h2>
                    @endcan
                    <div class="form-group row"><a href="{{route('cargarpaciente')}}" class="btn btn-primary ml-3">Cargar paciente</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
