<?php

use App\Http\Middleware\SetLocale;
use App\Providers\UrlServiceProvider;
use Illuminate\Foundation\Application;
use App\Http\Middleware\ForceDatabaseTranslator;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
            'setlocale' => SetLocale::class,


        ]);
        $middleware->prepend(ForceDatabaseTranslator::class);
        $middleware->append([
            SetLocale::class,
        ]);
    })
    ->withProviders([
        UrlServiceProvider::class, // Add this

    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
