@extends('layout')

@section('nombrePanel')
Paciente
@endsection

@section('tamañoPanel')
col-md-12
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
    <table class="table table-hover" style="text-align: center">
        <thead>
            <tr>
                <th scope="col">DNI</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Direccion</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Fecha de nacimiento</th>
                <th scope="col">Email</th>
                <th scope="col">Obra Social</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$paciente->dni}}</td>
                <td>{{$paciente->nombre}}</td>
                <td>{{$paciente->apellido}}</td>
                <td>{{$paciente->direccion}}</td>
                <td>{{$paciente->telefono}}</td>
                <td>{{date("d/m/Y",strtotime($paciente->fnac))}}</td>
                <td>{{$paciente->email}}</td>
                <td>{{$paciente->obrasocial}}</td>
            </tr>
        </tbody>
    </table>
</div>

@if (!empty($paciente->contacto) != NULL)
    <div style="overflow-x:auto;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-primary">Contacto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Relacion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>{{$paciente->contacto->nombre}}</td>
                    <td>{{$paciente->contacto->apellido}}</td>
                    <td>{{$paciente->contacto->telefono}}</td>
                    <td>{{$paciente->contacto->relacion}}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endif

@if (!empty($paciente->antecedentes) != NULL)
<div style="overflow-x:auto;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Antecedentes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$paciente->antecedentes}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endif

@endsection

@section('content2')
<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">Médicos asignados - ROOL JEFE</div>
                        <div class="card-body">
                            <a href="{{route('asignarmedico',$paciente)}}" class="btn btn-success btn">Asignar médico</a>
                            
                            <main class="mt-4">
                            <div style="overflow-x:auto;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellido</th>
                                            <th scope="col">Legajo</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paciente->users as $pu)
                                        <tr>
                                            <td>{{$pu->nombre}}</td>
                                            <td>{{$pu->apellido}}</td>
                                            <td>{{$pu->legajo}}</td>
                                            <td>{{$pu->nombreUsuario}}</td>
                                            <td><a href="{{route('desasignarmedico',['idP'=>$paciente->id, 'idM'=>$pu->id])}}" class="btn btn-danger btn-sm">Desasignar</a></td>
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

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">Sistemas</div>
                        <div class="card-body">


                            @if ($sistema->nombre == 'Guardia')
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cambio de sistema</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{route('cambio_uti',$paciente)}}" class="btn btn-danger btn">UTI</a>
                                                <a href="{{route('cambio_pc',$paciente)}}" class="btn btn-success btn">Piso Covid</a>
                                                <a href="{{route('cambio_obito',$paciente)}}" class="btn btn-dark btn">Óbito</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif ($sistema->nombre == 'Piso Covid')
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cambio de sistema</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{route('cambio_uti',$paciente)}}" class="btn btn-danger btn">UTI</a>
                                                <a href="{{route('cambio_hotel',$paciente)}}" class="btn btn-success btn">Hotel</a>
                                                <a href="{{route('cambio_domicilio',$paciente)}}" class="btn btn-success btn">Domicilio</a>
                                                <a href="{{route('cambio_obito',$paciente)}}" class="btn btn-dark btn">Óbito</a>
                                                <a href="{{route('cambio_egreso',['id'=>$paciente, 'tipo'=>'C'])}}" class="btn btn-success btn">Curado</a>
                                                <a href="{{route('cambio_egreso',['id'=>$paciente, 'tipo'=>'A'])}}" class="btn btn-success btn">Alta Epidemiológica</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif ($sistema->nombre == 'Unidad Terapia Intensiva')
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cambio de sistema</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{route('cambio_pc',$paciente)}}" class="btn btn-success btn">Piso Covid</a>
                                                <a href="{{route('cambio_obito',$paciente)}}" class="btn btn-dark btn">Óbito</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cambio de sistema</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{route('cambio_pc',$paciente)}}" class="btn btn-danger btn">Piso Covid</a>
                                                <a href="{{route('cambio_obito',$paciente)}}" class="btn btn-dark btn">Óbito</a>
                                                <a href="{{route('cambio_egreso',['id'=>$paciente, 'tipo'=>'C'])}}" class="btn btn-success btn">Curado</a>
                                                <a href="{{route('cambio_egreso',['id'=>$paciente, 'tipo'=>'A'])}}" class="btn btn-success btn">Alta Epidemiológica</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif



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
                                        @foreach($paciente->sistemas as $pc)
                                        <tr>
                                            <td>{{current($array)}}</td>
                                            <td>{{date("d/m/Y",strtotime($pc->pivot->inicio))}}</td>
                                            <td>{{!empty($pc->pivot->fin) ? date("d/m/Y",strtotime($pc->pivot->fin)):''}}</td>
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

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">Evoluciones</div>
                        <div class="card-body">
                            <a href="{{route('cargar_evolucion',$paciente)}}" class="btn btn-success btn">Cargar evolución</a>
                            <main class="mt-4">
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

                        </div>
                        
                </div>
            </div>
        </div>
    </div>
</main>

@endsection