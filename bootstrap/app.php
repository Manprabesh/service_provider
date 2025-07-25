<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Router;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        function (Router $router) {
            Route::middleware('web')->group(base_path('routes/web.php'));
            // Route::middleware('web')->prefix('api')->group(base_path('routes/web.php'));
            $router->middleware('web')->group(base_path('routes/ProviderAccount.php'));
        },

        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [

            "done"

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
