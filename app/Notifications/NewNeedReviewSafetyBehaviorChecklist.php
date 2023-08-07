<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNeedReviewSafetyBehaviorChecklist extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $newReview;

    public function __construct($newReview)
    {
        $this->newReview = $newReview;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('safety-behavior-checklist.review-by-pic', ['answer' => $this->newReview->id]);
        return (new MailMessage)
            ->line('Dokumen Baru Safety Behavior Checklist')
            ->action('Review Dokumen', $url)
            ->line('Jangan lupa untuk memberikan komentar pada laporan.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $url = route('safety-behavior-checklist.review-by-pic', ['answer' => $this->newReview->id]);
        return [
            'data' => 'Laporan baru butuh peninjau: ' . $this->newReview->nomor_laporan,
            'url' => $url,
        ];
    }
}
