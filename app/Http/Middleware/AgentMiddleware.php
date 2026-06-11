<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AgentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        // ✅ Admin always allowed
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        // ❌ Agent but NOT approved
        if ($user->hasRole('agent') && !$user->is_approved) {
            abort(403, 'Waiting for admin approval');
        }

        // ✅ Approved agent
        if ($user->hasRole('agent') && $user->is_approved) {
            return $next($request);
        }

        // ❌ fallback
        abort(403, 'Access denied');
    }
}