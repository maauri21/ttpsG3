@extends('layout')

@section('nombrePanel')
{{'Jefe Actual - ' . $sistema->nombre}}
@endsection

@section('tamañoPanel')
col-md-9
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
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Legajo</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{!empty($jefe->nombre) ? $jefe->nombre:''}}</td>
                <td>{{!empty($jefe->apellido) ? $jefe->apellido:''}}</td>
                <td>{{!empty($jefe->legajo) ? $jefe->legajo:''}}</td>
                <td>{{!empty($jefe->email) ? $jefe->email:''}}</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection

@section('content2')

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">{{ 'Nueva sala en ' . $sistema->nombre . '(ROOL ADMIN)' }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('crearsala',$sistema->id) }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            
                                    <div class="col-md-6">
                                        <input id="nombre" type="text" maxlength="25" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
                            
                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="camas" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad de camas') }}</label>
                            
                                    <div class="col-md-6">
                                        <input id="camas" type="text" maxlength="4" class="form-control @error('camas') is-invalid @enderror" name="camas" value="{{ old('camas') }}" required autocomplete="camas" autofocus>
                            
                                        @error('camas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Aceptar') }}
                                        </button>
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
            <div class="col-md-9">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">{{'Panel Jefe (ROOL JEFE) - ' . $sistema->nombre}}</div>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table table-hover" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width:15%" class="text-primary">Salas: {{$cantSalas}}</th>
                                            <th scope="col" style="width:22%" class="text-primary">Camas totales: {{$total}}</th>
                                            <th scope="col" style="width:22%" class="text-success">Camas libres: {{$libres}}</th>
                                            <th scope="col" style="width:25%" class="text-danger">Camas ocupadas: {{$ocupadas}}</th>
                                            <th scope="col" style="width:25%">Uso: {{$porcentaje}}%</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div style="overflow-x:auto;">
                                <table class="table table-hover" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width:15%">Sala</th>
                                            <th scope="col" style="width:35%">Nombre</th>
                                            <th scope="col" style="width:40%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salas as $item)
                                        <tr>
                                            <td scope="row">{{$item->id}}</td>
                                            <td>{{$item->nombre}}</td>
                                            <td><a href="{{route ('administrarsala', $item)}}" class="btn btn-info btn-sm">Ver</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$salas->links()}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">{{ __('Administrar salas de ' . $sistema->nombre . '(ROOL ADMIN)') }}</div>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table table-hover" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width:15%">Sala</th>
                                            <th scope="col" style="width:35%">Nombre</th>
                                            <th scope="col" style="width:40%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salas as $item)
                                        <tr>
                                            <td scope="row">{{$item->id}}</td>
                                            <td>{{$item->nombre}}</td>
                                            <td><a href="{{route ('editarsala', $item)}}" class="btn btn-warning btn-sm">Editar</a>  
                                                <form action="{{route('eliminarsala', $item) }}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm ('¿Está seguro?')">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$salas->links()}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">{{'Panel Médico (ROOL MEDICO) - ' . $sistema->nombre}}</div>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table table-hover" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width:15%">Sala</th>
                                            <th scope="col" style="width:35%">Nombre</th>
                                            <th scope="col" style="width:40%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salas as $item)
                                        <tr>
                                            <td scope="row">{{$item->id}}</td>
                                            <td>{{$item->nombre}}</td>
                                            <td><a href="{{route ('administrarsala', $item)}}" class="btn btn-info btn-sm">Ver</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$salas->links()}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>





@endsection