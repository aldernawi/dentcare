<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
{
    public function handle($request, Closure $next)
    {
        $locale = $request->header('Accept-Language', 'en');
        App::setLocale($locale);
        return $next($request);
    }
}