<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the locale is set in the session; if not, set it to 'en'
        if (!Session::has('locale')) {
            Session::put('locale', 'en'); // Default to English
        }

        // Get the locale from the session
        $locale = Session::get('locale');
        App::setLocale($locale); // Set the application locale

        return $next($request);
    }
}