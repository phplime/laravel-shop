<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SetLocale
{
    protected $supportedLocales;

    public function __construct()
    {
        $this->supportedLocales = config('localization.supported_locales', ['en', 'bn', 'es', 'fr']);
    }

    public function handle(Request $request, Closure $next)
    {
        $urlStyle = config('localization.url_style', 'query');

        if ($urlStyle === 'suffix') {
            // Get locale from URL suffix (e.g., /login/en)
            $segments = $request->segments();
            $lastSegment = end($segments);

            if (in_array($lastSegment, $this->supportedLocales)) {
                $lang = $lastSegment;
            } else {
                $lang = session('locale', config('localization.fallback_locale', 'en'));
            }
        } else {
            // Get locale from query parameter (e.g., ?lang=en)
            $lang = $request->query('lang')
                ?? session('locale')
                ?? config('localization.fallback_locale', 'en');
        }

        if (!in_array($lang, $this->supportedLocales)) {
            $lang = config('localization.fallback_locale', 'en');
        }

        App::setLocale($lang);
        session(['locale' => $lang]);
        URL::defaults(['lang' => $lang]);

        return $next($request);
    }
}
