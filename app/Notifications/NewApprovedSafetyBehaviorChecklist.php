<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApprovedSafetyBehaviorChecklist extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $approved;
    public function __construct($approved)
    {
        $this->approved = $approved;
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
        $url = route('safety-behavior-checklist.show', ['safety_behavior_checklist' => $this->approved->id]);
        return (new MailMessage)
                    ->line('Dokumen Safety Behavior Checklist Telah Disetujui.')
                    ->action('Cek Laporan', $url)
                    ->line('Terimakasih telah melaporkan temuan bahaya.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $url = route('safety-behavior-checklist.show', ['safety_behavior_checklist' => $this->approved->id]);
        return [
            'data' => 'Lihat Laporan ' . $this->approved->nomor_laporan,
            'url' => $url,
        ];
    }
}
