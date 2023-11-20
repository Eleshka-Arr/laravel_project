<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// Middleware логирует запросы передает в storage/logs/laravel.log
class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // before можем сделать любые действия, а потом пропустить запрос дальше
        // info('Название запроса', [массив параметров]); - функция хелпер, чтобы использовать логи в laravel
        // лог запрос и передача массива
        //info('Запрос', ['foo' => 'bar']);
        // $request->all() вернется массив всех параметров запроса
        // $request->url() вернется url запроса
        info($request->url(), $request->all());
        return $next($request);
        // $response = $next($request); // перехват ответа
        // after прописываем действия, при обратном возвращении запроса из контроллера
        // return $response;
    }
}
