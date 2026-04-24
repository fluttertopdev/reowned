<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App;
use Config;
use Exception;

class CheckWebsiteLanguage
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Check DB connection
            DB::connection()->getPdo();

            // Check if table exists
            if (Schema::hasTable('languages')) {

                if (!Session::has('website_locale') && !isset($_COOKIE['website_lang_code'])) {

                    $defaultCode = DB::table('languages')
                        ->where('is_default', 1)
                        ->value('code');

                    $defaultCode = $defaultCode ?: 'en';

                    App::setLocale($defaultCode);
                    Session::put('website_locale', $defaultCode);
                    setcookie('website_lang_code', $defaultCode, time() + (60 * 60 * 24 * 365), "/");

                } else {
                    $lang = Session::get(
                        'website_locale',
                        $_COOKIE['website_lang_code'] ?? Config::get('app.locale', 'en')
                    );

                    App::setLocale($lang);
                }

            } else {
                // Table not exists fallback
                App::setLocale('en');
            }

        } catch (Exception $e) {
            // DB connection failed fallback
            App::setLocale('en');
        }

        return $next($request);
    }
}