<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // проверяем админ ли пользователь
        if ($this->isAdmin($request)) {
            return $next($request);
        }

        abort(403);
        //throw new AuthorizationException(); // исключение это действие не авторизовано
        //return redirect()->route('message', ['action' => 'denied']); // есть страница с сообщениями и по этому параметру показываем сообщение
    }

    protected function isAdmin(Request $request)
    {
        //$user = $request->user(); // получаем пользователя
        //return $user->active; // в базе свойство пользователя active булево
        //return $request->user()->admin; // админ ли пользователь
        return false;
    }

}
