@extends('layout')

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Notificaciones  No Leidas</div>
            <div class="card-body">

              @if (auth()->user())
              @forelse ($evolucionNotifications as $notification)
              <div class="alert alert-default-warning">
                Alerta: {{ $notification->data['textoAlerta'] }}
                <p>{{ $notification->created_at->diffForHumans() }}</p>
                <button type="submit" class="mark-as-read btn btn-sm btn-dark" data-id="{{ $notification->id }}">Marcar como leida</button>
              </div>
              @if ($loop->last)
                <a href="#" id="mark-all">Marcar todas como leidas</a>
                  
              @endif
              
              @empty
                There are no notifications                  
              @endforelse
                          
              @endif
                            
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
