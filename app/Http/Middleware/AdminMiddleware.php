<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next)
    {
        $user = auth()->user();

        if (! $user || ! method_exists($user, 'isAdmin') || ! $user->isAdmin()) {
            // Redirect ke landing jika bukan admin
            return redirect()->route('landing');
        }

        return $next($request);
    }
}
