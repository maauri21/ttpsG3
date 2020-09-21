@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Panel') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can('cargarPersonal')
                    <a href="{{route('register')}}" class="btn btn-primary">Cargar personal</a>
                    @endcan
                    @can('cargarPaciente')
                    <h2>Cosa de medico</h2>
                    @endcan
                    <a href="{{route('cargarpaciente')}}" class="btn btn-primary">Cargar paciente</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
