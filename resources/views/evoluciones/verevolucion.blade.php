@extends('layout')

@section('nombrePanel')
Notificaciones sin leer
@endsection

@section('tamañoPanel')
col-md-8
@endsection

@section('content')

              @if (auth()->user())
              @forelse ($evolucionNotifications as $notification)
              <div class="alert alert-default-warning">
                {{ $notification->data['textoAlerta'] }}
                <p>{{ $notification->created_at->diffForHumans() }}</p>
                <button type="submit" class="mark-as-read btn btn-sm btn-dark" data-id="{{ $notification->id }}">Marcar como leida</button>
              </div>
              @if ($loop->last)
                <a href="#" id="mark-all">Marcar todas como leidas</a>
                  
              @endif
              
              @empty
                Sin notificaciones
              @endforelse
                          
              @endif

@endsection
