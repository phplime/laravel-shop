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

        // For db/single styles, get locale from session or config only
        if (in_array($urlStyle, ['db', 'single'])) {
            $lang = session('locale', config('localization.fallback_locale', 'en'));
        }
        // For suffix style, get locale from URL suffix (e.g., /login/en)
        elseif ($urlStyle === 'suffix') {
            $segments = $request->segments();
            $lastSegment = end($segments);

            if (in_array($lastSegment, $this->supportedLocales)) {
                $lang = $lastSegment;
            } else {
                $lang = session('locale', config('localization.fallback_locale', 'en'));
            }
        }
        // For query style, get locale from query parameter (e.g., ?lang=en)
        else {
            $lang = $request->query('lang')
                ?? session('locale')
                ?? config('localization.fallback_locale', 'en');
        }

        // Validate locale
        if (!in_array($lang, $this->supportedLocales)) {
            $lang = config('localization.fallback_locale', 'en');
        }

        App::setLocale($lang);
        session(['locale' => $lang]);

        // Only set URL defaults for query/suffix styles
        if (!in_array($urlStyle, ['db', 'single'])) {
            URL::defaults(['lang' => $lang]);
        }

        return $next($request);
    }
}
