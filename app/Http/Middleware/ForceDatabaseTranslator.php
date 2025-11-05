<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Translation\Translator;
use App\Services\DatabaseLoader;

class ForceDatabaseTranslator
{
    public function handle(Request $request, Closure $next)
    {
        $app = app();

        // Always replace translator with our DB-backed one
        $loader = new DatabaseLoader();
        $locale = $app['config']['app.locale'];
        $fallback = $app['config']['app.fallback_locale'];

        $translator = new Translator($loader, $locale);
        $translator->setFallback($fallback);

        $app->instance('translator', $translator);
        $app->instance('translation.loader', $loader);

        return $next($request);
    }
}