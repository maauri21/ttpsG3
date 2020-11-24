@extends('layout')

@section('nombrePanel')
Notificaciones Anteriores
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')

              @if (auth()->user())
              @forelse ($evolucionNotifications as $notification)
              <div class="alert alert-success">
                {{ $notification->data['textoAlerta'] }}
                <p>{{ $notification->created_at->diffForHumans() }}</p>
              </div>

              @empty
                Sin notificaciones
              @endforelse
     
              @endif

              
              

@endsection
