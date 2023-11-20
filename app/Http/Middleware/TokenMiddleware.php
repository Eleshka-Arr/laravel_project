<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// middleware определяет есть ли в запросе определенный токен (секретный ключ), только если он есть и он правильный будет пропускать этот запрос
class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $token): Response // принимаем параметры $token, $foo из middleware main.php
    {
        //info('log', ['foo' => 'bar']); // функция позволяет записывать в логи
        //abort(500); // функция принимает статус код и выводит на экран (404 не найдено, 500 ошибка сервера)
        //abort_if(5 < 1, 500); // функция проверяет условие, и если true выводит статус ошибку
        //abort_unless($user->admin, 500); // функция проверяет условие, и если не является true (пользователь не админ), то выводит статус ошибку
        //dd($request, 123, ['foo' => 'bar']); //dd($request); - целый объект со свойствами, dd($foo); - отправляет на вывод значение в браузер, но на этой функции программа останавливается и перестает дальше выполняться, позволяет распечатать те значения, которые мы в нее передаем, можно использовать для проверки выполняется ли условие, работает ли определенная часть кода
        //dump($request); // как dd() функция, но продолжает выполнение скрипта
        //$token = 'secret'; // $token = 'secret' в строке браузера параметр должен быть ?token=secret, более правильный способ: env('TOKEN') - в файле .env добавляем TOKEN и значение, если закэшируем, то такой env не будет работать и будет возвращать null, еще более правильный способ: config('example.token')

        if($request->input('token') === $token){// input('token') - метод позволяет получить параметры из запроса, === $token - если равен токену, all('token') - все параметры из запроса

            return $next($request);

        }

        abort(403);
    }
}
