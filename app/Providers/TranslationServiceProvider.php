<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use App\Models\LanguageData;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $locale = App::getLocale();

        // Load translations from cache or database
        $translations = Cache::rememberForever("lang_{$locale}", function () use ($locale) {
            return LanguageData::where('locale', $locale)
                ->pluck('value', 'key')
                ->toArray();
        });



        // Replace Laravel's default translator with our dynamic loader
        App::singleton('translator', function ($app) use ($translations, $locale) {
            $loader = new ArrayLoader();
            $loader->addMessages($locale, '*', $translations);

            return new Translator($loader, $locale);
        });
    }
}
