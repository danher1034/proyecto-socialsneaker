<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Middleware para controlar el idioma de la app
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale', 'es');
        App::setLocale($locale);

        return $next($request);
    }
}

