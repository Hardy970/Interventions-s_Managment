<?php

namespace App\Notifications;

use App\Models\Intervention;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewInterventionAdminNotification extends Notification
{
    use Queueable;
    protected $intervention;

    /**
     * Create a new notification instance.
     */
    public function __construct(Intervention $intervention)
    {
        $this->intervention = $intervention;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nouvelle intervention ajoutée')
                    ->line('Une nouvelle intervention a été ajoutée.')
                    ->action('Voir intervention', route('admin.interventions.show', $this->intervention->id))
                    ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
