<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\SafetyIndexThresholdReached;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SafetyIndexThresholdNotification;

class NotifyUsersOnSafetyIndexThreshold
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
    public function handle(SafetyIndexThresholdReached $event): void
    {
        // Get the users affiliated with the company
        $users = $event->company->users;

        // Send notifications to the users
        Notification::send($users, new SafetyIndexThresholdNotification($event->year, $event->safetyIndexPercentage));
    }
}
