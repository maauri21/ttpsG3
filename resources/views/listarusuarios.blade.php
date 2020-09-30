@extends('layouts.app')

@section('content')

  <h1>Usuarios</h1>
  @if (session('mensaje'))
  <div class="alert alert-success">{{ session('mensaje') }}

  </div>
  @endif  
  <table class="table table-hover" style="text-align: center">
    <thead>
        <tr>
        <th scope="col">#id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Legajo</th>
        <th scope="col">Email</th>
        <th scope="col">Nombre Usuario</th>
        <th scope="col">Contraseña</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $item)

            
       
         <tr>
            <th scope="row">{{$item->id}}</th>
            <td>
                <a href="{{route ('verdetalle', $item)}}">
                   {{$item->nombre}}
                </a>
              </td>
            
            <td>{{$item->apellido}}</td>
            <td>{{$item->legajo}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->nombreUsuario}}</td>
            <td>{{$item->password}}</td>
         <td><a href="{{route ('editorusuario', $item)}}" class = "btn btn-warning bt-sm" >Editar</a>
         <form action="{{route('eliminarusuario', $item) }}" method="POST" class="d-inline">
            @method('DELETE') 
            @csrf
            <button class ="btn btn-danger btn-sm" type="submit">Eliminar</button>  
          </form>  
        
        </td>
      </tr>
      @endforeach
    
    </tbody>
  </table>
  
@endsection






