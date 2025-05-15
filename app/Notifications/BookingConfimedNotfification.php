<?php

namespace App\Notifications;

use App\Models\Bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfimedNotfification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $booking;
    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Booking andan telah di konfirmasi')
            ->greeting('Halo' . $notifiable->name)
            ->line('Booking Anda telah dikonfirmasi dengan detail berikut:')
            ->line('Tanggal: ' . $this->booking->booking_date)
            ->line('Waktu: ' . $this->booking->booking_time)
            ->line('Barber: ' . $this->booking->barber->name)
            ->action('Lihat Detail Booking', url('/customer/bookings/' . $this->booking->id))
            ->line('Terima kasih telah menggunakan layanan kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Booking Anda telah dikonfirmasi oleh admin.',
            'booking_id' => $this->booking->id,
            'booking_date' => $this->booking->booking_date,
            'booking_time' => $this->booking->booking_time,
            'barber_name' => $this->booking->barber->name,
        ];
    }
}
