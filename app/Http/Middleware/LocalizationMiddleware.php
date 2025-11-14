<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is set in session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);
        }
        // Optional: Set from user preference or browser
        else {
            // Get browser language
            $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $availableLocales = ['en', 'hi', 'es', 'fr'];
            
            if (in_array($browserLang, $availableLocales)) {
                App::setLocale($browserLang);
                Session::put('locale', $browserLang);
            } else {
                App::setLocale(config('app.fallback_locale'));
                Session::put('locale', config('app.fallback_locale'));
            }
        }

        return $next($request);
    }
}