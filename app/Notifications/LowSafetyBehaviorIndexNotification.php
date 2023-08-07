<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowSafetyBehaviorIndexNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     */
    public function __construct(object $data)
    {
        $this->data = $data;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Rata-rata Safety Behavior Index kurang dari 50!')
            ->action('Kunjungi Website', url('/'))
            ->line('Peringatan, perusahaan ' . $this->data->company_name . ' mencapai Nilai Keselamatan dengan kategori kurang! Sanksi akan diterapkan menurut SOP reward and punishment. Dimohon Safety Officer Perusahaan untuk Menemuni SHE.')
            ->line('Terimakasih Atas pengertiannya. Tetap Jaga Keselamatan. Salam Safety!');
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
