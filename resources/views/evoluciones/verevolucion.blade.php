@extends('layout')

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Notificaciones  No Leidas</div>
            <div class="card-body">

              @if (auth()->user())
              @forelse ($EvolucionNotifications as $notification)
              <div class="alert alert-default-warning">
                Post title: {{ $notification->data['id'] }}
                <p>{{ $notification->created_at->diffForHumans() }}</p>
                <button type="submit" class="mark-as-read btn btn-sm btn-dark" data-id="{{ $notification->id }}">Mark as read</button>
              </div>
              @if ($loop->last)
                <a href="#" id="mark-all">Mark all as read</a>
                  
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
