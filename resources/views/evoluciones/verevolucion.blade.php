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

              <br/><button type="submit" class="btn btn-primary mt-3">Notificaciones anteriores</button>Que el boton me mande a una vista como esta pero con las notificaciones leidas como tiene la campanita
                          
              @endif

@endsection
