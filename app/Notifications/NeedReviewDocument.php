<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NeedReviewDocument extends Notification
{
    use Queueable;
    public $user;
    public $form;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $form)
    {
        $this->user = $user;
        $this->form = $form;
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
        return (new MailMessage)
                ->line('Terdapat Dokumen yang perlu di review.')
                ->action('Review', url('/safety-observation-forms/' . $this->form->id))
                ->line('Terimakasih atas perhatiannya!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'role' => $this->user->role('SHE'),
            'message' => 'You have a new form submission that requires review.',
            'created_at' => now(),
            'form' => $this->form,
        ];
    }

    public function broadcastOn()
    {
        return ['database'];
    }
}
