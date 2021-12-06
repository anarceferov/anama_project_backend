<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $this->setLocale($request);
        return $next($request);
    }

    private function setLocale($request)
    {
        $locale = $request->header("Accept-Language") ?: config("app.fallback_locale");
        App::setLocale($locale);
    }
}
