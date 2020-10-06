@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                @if ( session('mensaje') )
                <div class="alert alert-success mb-2">{{ session('mensaje') }}</div>
                @endif
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">{{ __('Administrar usuarios') }}</div>
                    <div style="overflow-x:auto;">
                    <table class="table table-hover" style="text-align: center">
                        <thead>
                            <tr>
                              <th scope="col">id</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Apellido</th>
                              <th scope="col">Legajo</th>
                              <th scope="col">Email</th>
                              <th scope="col">Usuario</th>
                              <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $item)
                            <tr>
                                <td scope="row">{{$item->id}}</td>
                                <td>
                                     {{$item->nombre}}
                                  </a>
                                </td>
                                <td>{{$item->apellido}}</td>
                                <td>{{$item->legajo}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->nombreUsuario}}</td>
                                <td>
                                    <a href="{{route ('editorusuario', $item)}}" class="btn btn-warning btn-sm">Editar</a>  
                                    <form action="{{route('eliminarusuario', $item) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                    </form>
                                </td>
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

@endsection