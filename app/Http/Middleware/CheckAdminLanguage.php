<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App;
use Config;


class CheckAdminLanguage
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Session()->has('admin_locale') && array_key_exists(Session()->get('admin_locale'), config('languages'))) {
            App::setLocale(Session()->get('admin_locale'));
        } else {
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
