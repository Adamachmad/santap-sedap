<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
->withMiddleware(function (Middleware $middleware) {
    // MED-01 / LOW-01: Terapkan Security Headers ke SEMUA response web
    $middleware->web(append: [
        \App\Http\Middleware\SecurityHeadersMiddleware::class,
    ]);

    $middleware->alias([
        'is.admin' => \App\Http\Middleware\IsAdminMiddleware::class,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
