<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('staff')->check()) {
            return redirect()->route('staffloginlogin.index');
        }

        if (Auth::guard('staff')->user()->type !== 'staff') {
            Auth::guard('staff')->logout();
            return redirect()->route('staffloginlogin.index');
        }

        return $next($request);
    }
}
