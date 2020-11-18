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
                Notification::send($user, new EvolucionNotification($event->evolucion));
                #$user->notify(new Evolucion)
            #Notification::send($users, new InvoicePaid($invoice));
   
            });
    } 
}

# En este archivo pongo la logica para que se disparen las alertas, aca de alguna forma debo hacere que le mande al doctor que tiene asociado ese paciente
