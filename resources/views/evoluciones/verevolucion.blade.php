@extends('layout')

@section('nombrePanel')
Notificaciones
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')

              @if (auth()->user())
              @forelse ($evolucionNotifications as $notification)
              <div class="alert alert-warning">
                {{ $notification->data['textoAlerta'] }}
                <p>{{ $notification->created_at->diffForHumans() }}</p>
                  <a href="{{ route('markOne', $notification->id) }}" class="btn btn-sm btn-dark">Marcar como leida</a>
              </div>
              @if ($loop->last)
                
              <br/><a href="{{route ('markAsRead')}}" class="btn btn-success">Marcar todas como leídas</a>
                  
              @endif
              
              @empty
                Sin notificaciones
              @endforelse

              
              <br/><a href="{{route ('mostrar_leidas')}}" class="btn btn-primary mt-3">Notificaciones anteriores</a>
       
              @endif

              
              

@endsection
