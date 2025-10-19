<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureCustomerMiddleware
{
    /**
     * Block admins from accessing customer-facing features.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat mengakses fitur pelanggan.');
        }

        return $next($request);
    }
}

