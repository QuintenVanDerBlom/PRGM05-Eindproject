<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check op de user state
        if ($user && $user->role === 1) { // 1 = Admin 0 = User
            $trailCount = $user->hikingTrails()->count();

            if ($trailCount >= 5) {
                return $next($request);
            }
        }

        return redirect()->route('home')->withErrors('Access denied: You need to create at least 5 hiking trails to manage users.');
    }
}
