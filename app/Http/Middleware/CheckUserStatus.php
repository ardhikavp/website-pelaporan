<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Notifications\UserApprovedNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->status === 'PENDING_APPROVAL') {
            return redirect()->route('welcome')->with('info', 'Akun Anda menunggu persetujuan admin.');
        }
        // $user = User::find(1);
        // $user->notify(new UserApprovedNotification('Your account has been approved.'));
        return $next($request);


    }

}
