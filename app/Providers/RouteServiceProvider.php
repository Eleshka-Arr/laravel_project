<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) { // ограничение запросов по ':api'
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip()); // perHour() - в час, 60 запросов в минуту, ->by - по параметру либо id пользователя, а если его нет, то по ip
        });

        /*RateLimiter::for('test', function (Request $request) { // можем создать второй middleware, по имени test
            return Limit::perHour(10)->by($request->user()?->id ?: $request->ip()); // perHour() - в час
        });*/

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web') //'token' можем применить на все маршруты middleware в группе применится
                //->group(base_path('routes/main.php')); // передается путь
                    // передается функция
                ->group(function (){
                    // передаем функцию разделение по отдельным путям
                    require_once base_path('routes/main.php');
                    require_once base_path('routes/user.php');
                    require_once base_path('routes/admin.php');
                });
        });
    }
}
