<?php

use App\Http\Middleware\AuthUserValidation;
use App\Http\Middleware\isAdminValidation;
use App\Http\Middleware\isGuessValidation;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'authUser' => AuthUserValidation::class,
            'isAdmin' => isAdminValidation::class,
            'isGuess' => IsGuessValidation::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
