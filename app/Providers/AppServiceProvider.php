<?php

namespace App\Providers;

use App\Translation\DatabaseLoader;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Translation\Translator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('js', function ($expression) {
            return "<?php
            \$__files = is_array($expression) ? $expression : [$expression];
            foreach (\$__files as \$__file) {
                if (!str_ends_with(\$__file, '.js')) {
                    \$__file .= '.js';
                }
                \$__url = asset('assets/js/' . \$__file);
                \$__env->startPush('scripts');
                echo '<script src=\"' . e(\$__url) . '\"></script>';
                \$__env->stopPush();
            }
        ?>";
        });
    }
}
