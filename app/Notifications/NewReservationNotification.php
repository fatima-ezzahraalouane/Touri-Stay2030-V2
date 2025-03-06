<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReservationNotification extends Notification
{
    use Queueable;

    protected $reservation;

    /**
     * Create a new notification instance.
     */

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Nouvelle réservation pour votre annonce "' . $this->reservation->annonce->titre . '".')
            ->line('Du ' . date('d/m/Y', strtotime($this->reservation->date_debut)) .
                ' au ' . date('d/m/Y', strtotime($this->reservation->date_fin)) . '.')
            ->action('Voir les détails', url('/proprietaire/reservations/' . $this->reservation->id))
            ->line('Merci d\'utiliser TouriStay 2030!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'annonce_id' => $this->reservation->annonce_id,
            'annonce_titre' => $this->reservation->annonce->titre,
            'date_debut' => $this->reservation->date_debut,
            'date_fin' => $this->reservation->date_fin,
            'user_id' => $this->reservation->user_id,
            'user_name' => $this->reservation->user->name,
            'message' => 'Nouvelle réservation pour votre annonce "' . $this->reservation->annonce->titre .
                '" du ' . date('d/m/Y', strtotime($this->reservation->date_debut)) .
                ' au ' . date('d/m/Y', strtotime($this->reservation->date_fin)) . '.'
        ];
    }
}
