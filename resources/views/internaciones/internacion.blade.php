@extends('layout')

@section('nombrePanel')
Evoluciones
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
<div style="overflow-x:auto;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evoluciones as $evolucion)
            <tr>
                <td>{{date("d/m/Y",strtotime($evolucion->fecha))}}</td>
                <td>{{substr($evolucion->hora, 0, -3)}}</td>
                <td><a href="{{route('ver_evolucion',$evolucion->id)}}" class="btn btn-info btn-sm">Ver</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$evoluciones->links()}}
<a href="{{route ('internaciones', $paciente->id)}}" class="btn btn-primary">Volver</a>
@endsection

@section('content2')

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">Sistemas</div>
                        <div class="card-body">
                                <div style="overflow-x:auto;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Desde</th>
                                                <th scope="col">Hasta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($internacion->sistemas as $interSist)
                                            <tr>
                                                <td>{{current($array)}}</td>
                                                <td>{{date("d/m/Y",strtotime($interSist->pivot->inicio))}}</td>
                                                <td>{{!empty($interSist->pivot->fin) ? date("d/m/Y",strtotime($interSist->pivot->fin)):''}}</td>
                                            </tr>
                                                <?php next($array) ?>
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