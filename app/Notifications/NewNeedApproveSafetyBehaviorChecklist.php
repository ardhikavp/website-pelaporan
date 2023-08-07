<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNeedApproveSafetyBehaviorChecklist extends Notification
{
    use Queueable;

    protected $newApprove;
    /**
     * Create a new notification instance.
     */
    public function __construct($newApprove)
    {
        $this->newApprove = $newApprove;
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
        $url = route('safety-behavior-checklist.approve-by-manager', ['answer' => $this->newApprove->id]);
        return (new MailMessage)
                ->line('Tinjauan Dokumen Safety Behavior Checklist')
                ->action('Approve Dokumen', $url)
                ->line('Jangan lupa untuk memberikan komentar pada laporan.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $url = route('safety-behavior-checklist.approve-by-manager', ['answer' => $this->newApprove->id]);
        return [
            'data' => 'Setujui Laporan ' . $this->newApprove->nomor_laporan,
            'url' => $url,
        ];
    }
}
