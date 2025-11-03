<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator as BaseUrlGenerator;
use Illuminate\Support\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('url', function ($app) {
            $routes = $app['router']->getRoutes();
            $app->instance('routes', $routes);

            return new class(
                $routes,
                $app->rebinding('request', function ($app, $request) {
                    $app['url']->setRequest($request);
                }),
                $app['config']['app.asset_url']
            ) extends BaseUrlGenerator {

                public function route($name, $parameters = [], $absolute = true)
                {
                    $urlStyle = config('localization.url_style', 'query');
                    $currentLocale = app()->getLocale();
                    $defaultLocale = config('app.locale', 'en');

                    // ✅ For db/single, skip adding any locale
                    if (in_array($urlStyle, ['db', 'single'])) {
                        return parent::route($name, $parameters, $absolute);
                    }

                    // ✅ For suffix style: append locale as last segment
                    if ($urlStyle === 'suffix') {
                        if (!isset($parameters['locale']) && is_array($parameters)) {
                            $parameters['locale'] = $currentLocale;
                        }
                    }
                    // ✅ For query style: add ?lang=en
                    elseif ($urlStyle === 'query') {
                        if (!isset($parameters['lang'])) {
                            $parameters['lang'] = $currentLocale;
                        }
                    }

                    $url = parent::route($name, $parameters, $absolute);

                    // Ensure suffix URL is clean
                    if ($urlStyle === 'suffix' && strpos($url, '?locale=') !== false) {
                        $url = str_replace('?locale=' . $currentLocale, '/' . $currentLocale, $url);
                    }

                    return $url;
                }

                public function to($path, $extra = [], $secure = null)
                {
                    $urlStyle = config('localization.url_style', 'query');
                    $currentLocale = app()->getLocale();
                    $defaultLocale = config('app.locale', 'en');

                    // ✅ For db/single, return clean URLs
                    if (in_array($urlStyle, ['db', 'single'])) {
                        return parent::to($path, $extra, $secure);
                    }

                    if ($urlStyle === 'suffix') {
                        $path = rtrim($path, '/') . '/' . $currentLocale;
                        return parent::to($path, $extra, $secure);
                    }

                    if ($urlStyle === 'query') {
                        $url = parent::to($path, $extra, $secure);
                        $separator = parse_url($url, PHP_URL_QUERY) ? '&' : '?';
                        return $url . $separator . 'lang=' . $currentLocale;
                    }

                    return parent::to($path, $extra, $secure);
                }
            };
        });
    }
}
