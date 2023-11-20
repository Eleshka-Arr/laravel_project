<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // проверяем не заблокирован ли пользователь
        if ($this->isActive($request)) {
            return $next($request);
        }

        abort(403); // программа прекращает выполнение и вернет ответ со статусом 403

    }

    protected function isActive(Request $request)
    {
        //$user = $request->user(); // получаем пользователя
        //return $user->active; // в базе свойство пользователя active булево
        return true;
    }
}
