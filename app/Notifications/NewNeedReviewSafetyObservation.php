<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNeedReviewSafetyObservation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $newReview;

    public function __construct($newReview)
    {
        $this->needReviewSO = $newReview;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail' , 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Dokumen Baru Safety Observation')
                    ->action('Review Dokumen', route('safety-observation-forms.review-by-she'))
                    ->line('Jangan lupa untuk memberikan komentar pada laporan.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'data' => 'New user registered with email: ' . $this->needReviewSO->email,
        ];
    }
}
