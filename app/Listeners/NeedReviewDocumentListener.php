<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NeedReviewDocument;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NeedReviewDocumentListener implements ShouldBroadcast
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    public function broadcastOn()
    {
        return [ 'database'];
    }
    /**
     * Handle the event.
     */
    // public function handle(NeedReviewDocument $notification)
    // {
    //     $notification->save();

    // }
}
