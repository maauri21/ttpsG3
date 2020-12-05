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

<div style="overflow-x:auto;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Inicio de síntomas</th>
                <th scope="col">Diagnóstico de COVID</th>
                <th scope="col">Internación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{date("d/m/Y",strtotime($internacion->fIniciosintomas))}}</td>
                <td>{{date("d/m/Y",strtotime($internacion->fDiagnosticocovid))}}</td>
                <td>{{date("d/m/Y",strtotime($internacion->fInternacion))}}</td>
            </tr>
        </tbody>
    </table>
</div>

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
                    <div class="card-header text-white bg-primary">Sistemas y Evoluciones</div>
                        <div class="card-body">


                            @if ($sistema->nombre == 'Guardia')
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cambio de sistema</th>
                                            <th scope="col" style="width:25%">Evolución</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{route('cambio_uti',$paciente)}}" class="btn btn-danger btn">UTI</a>
                                                <a href="{{route('cambio_pc',$paciente)}}" class="btn btn-success btn">Piso Covid</a>
                                                <a href="{{route('cambio_obito',$paciente)}}" class="btn btn-dark btn">Óbito</a>
                                            </td>
                                            <td><a href="{{route('cargar_evolucion',$paciente)}}" class="btn btn-success btn">Cargar evolución</a></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                
                            @elseif ($sistema->nombre == 'Piso Covid')
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cambio de sistema</th>
                                            <th scope="col" style="width:25%">Evolución</th>

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
                                            <td><a href="{{route('cargar_evolucion',$paciente)}}" class="btn btn-success btn">Cargar evolución</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif ($sistema->nombre == 'Unidad Terapia Intensiva')
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cambio de sistema</th>
                                            <th scope="col" style="width:25%">Evolución</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{route('cambio_pc',$paciente)}}" class="btn btn-success btn">Piso Covid</a>
                                                <a href="{{route('cambio_obito',$paciente)}}" class="btn btn-dark btn">Óbito</a>
                                            </td>
                                            <td><a href="{{route('cargar_evolucion',$paciente)}}" class="btn btn-success btn">Cargar evolución</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Cambio de sistema</th>
                                            <th scope="col" style="width:25%">Evolución</th>

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
                                            <td><a href="{{route('cargar_evolucion',$paciente)}}" class="btn btn-success btn">Cargar evolución</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif



                            <div style="overflow-x:auto;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($evo_y_cambios as $ec)
                                        <tr>
                                            @if(!empty($ec->sistema_id))
                                                <td class="text-primary"><b>{{$ec->sistema_id}}</b></td>
                                                <td>{{date("d/m/Y H:i",strtotime($ec->fecha))}}</td>
                                                <td>-</td>
                                            @else
                                                <td class="text-success"><b>{{'Evolución'}}</b></td>
                                                <td>{{date("d/m/Y H:i",strtotime($ec->fecha))}}</td>
                                                <td><a href="{{route('ver_evolucion',$ec->id)}}" class="btn btn-info btn-sm">Ver</a></td>
                                            @endif
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