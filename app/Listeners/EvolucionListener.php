<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EvolucionNotification;
use App\Models\User;

class EvolucionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        User::all()
            ->each (function(User $user) use($event){
                foreach ($user->pacientes as $up) {                    
                    if ($up->id == $event->evolucion->paciente_alerta) {      # Si mi paciente coincide con el que estoy cargando, mando alerta
                        Notification::send($user, new EvolucionNotification($event->evolucion));
                        break;
                    }
                }
            });
    } 
}