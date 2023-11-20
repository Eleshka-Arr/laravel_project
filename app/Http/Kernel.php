<?php

namespace App\Http;

use App\Http\Middleware\LogMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    // массивы регистрируются middleware глобально, срабатывают на все приложение
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class, // обычно не нужен
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // конвертирует пустые строки в запросе в null ('' => null)

        \App\Http\Middleware\LogMiddleware::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    // группы Middleware - объединение нескольких middleware в группу, на route можно применять по названию группы их маршруты
    protected $middlewareGroups = [
        'web' => [ //маршруты применяются в файле web.php, а сейчас на файлы admin.php, main.php, user.php
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class, // начинает сесию когда запрос приходит
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, //возвращает ошибки валидации
            \App\Http\Middleware\VerifyCsrfToken::class, // проверяет csrf token
            \Illuminate\Routing\Middleware\SubstituteBindings::class, //регистрирует привязки
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api', //алиас, нужен для того, чтобы ограничивать количество запросов в определенный промежуток времени на один ip адрес, ':api' - это ограничение, регистрируется в RouteServiceProvider, можно написать например ':10,60' - 10 запросов в минуту, 60 (в час)
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        /*'test' =>[
            LogMiddleware::class,
        ]*/
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    // алиасы
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        'active' => \App\Http\Middleware\ActiveMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'token' => \App\Http\Middleware\TokenMiddleware::class,


        //'log' => \App\Http\Middleware\LogMiddleware::class,
    ];
}
