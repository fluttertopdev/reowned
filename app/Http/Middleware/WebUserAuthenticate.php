<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebUserAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return redirect('/');
        }

        if (Auth::guard('web')->user()->type !== 'user') {
            Auth::guard('web')->logout();
            return redirect('/');
        }

        return $next($request);
    }
}