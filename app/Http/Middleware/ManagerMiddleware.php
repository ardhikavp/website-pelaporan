<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !$this->isManager()) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
    /**
     * Check if the authenticated user is an admin.
     *
     * @return bool
     */
    private function isManager()
    {
        // Modify this logic based on your user role implementation
        return auth()->check() && auth()->user()->role === 'manager maintenance';
    }
}
