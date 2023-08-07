<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // public function notification()
    // {
    //     $user = Auth::user();

    //     $notifications = DB::table('notifications')
    //         ->where('notifiable_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10);

    //         if ($user->notifications->isNotEmpty()) {
    //             // Fetch the notification data for the user (assuming you want to pass the first notification)
    //             $notificationData = $user->notifications->first()->toArray();
    //         } else {
    //             // If there are no notifications, set $notificationData to null or an empty array
    //             $notificationData = null; // or $notificationData = [];
    //         }

    //     return view('notifications.notification-index', compact('notifications', 'notificationData'));
    // }


    public function index()
    {
            $user = Auth::user();
            $notifications = $user->notifications;

            return view('notifications.notification-index', compact('notifications'));
    }


    // public function markAsRead(Request $request, $id)
    // {
    //     $user = Auth::user();

    //     // Pastikan notifikasi dimiliki oleh pengguna yang sedang login
    //     $notification = DB::table('notifications')
    //         ->where('id', $id)
    //         ->where('notifiable_id', $user->id)
    //         ->first();

    //     if ($notification) {
    //         DB::table('notifications')
    //             ->where('id', $id)
    //             ->update(['read_at' => now()]);
    //     }

    //     return redirect()->back();
    // }
    public function markAsReadDB($id)
    {
        // Mark the notification as read using a DB query
        DB::table('notifications')
            ->where('id', $id)
            ->update(['read_at' => now()]);

        // Redirect back or to a specific page
        return redirect()->back();
    }
}
