<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Evolucion;

class EvolucionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Evolucion $evolucion)
    {
        $this->evolucion = $evolucion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'evolucion'  => $this->evolucion->id,
            'tasistolica' => $this->evolucion->tasistolica,
            'tadiastolica' => $this->evolucion->tadiastolica,
            'fc' => $this->evolucion->fc,
            'fr' => $this->evolucion->fr,
            'canulanasal' => $this->evolucion->canulanasal,
            'mascarares' => $this->evolucion->mascarares,
            'sato2' => $this->evolucion->sato2,
            'valorpafi' => $this->evolucion->valorpafi,
        ];
    }
}
