<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserRegistered;
use App\Notifications\NewRegisterUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendAdminNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $admins = User::where('role', 'admin')->get();

        Notification::send($admins, new NewRegisterUser($event->user));
    }
}
