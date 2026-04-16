<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login.index');
        }

        // Extra protection
        if (Auth::guard('admin')->user()->type === 'user') {
            Auth::guard('admin')->logout();
            return redirect()->route('login.index');
        }

        config(['auth.defaults.guard' => 'admin']);

        return $next($request);
    }
}