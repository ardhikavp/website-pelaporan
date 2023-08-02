<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        // Mark notifications as read after displaying them
        $user->unreadNotifications->markAsRead();

        return view('notifications', compact('notifications'));
    }

    public function markAsRead($notificationId)
    {
        $user = auth()->user();
        $notification = $user->unread->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            return redirect()->back()->with('success', 'Notification marked as read.');
        }

        return redirect()->back()->with('error', 'Notification not found.');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['message' => 'All notifications marked as read.']);
    }

    public function markNotificationAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');

        $notification = Auth::user()->unreadNotifications->where('id', $notificationId)->first();
        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['message' => 'Notification marked as read.']);
    }

}
