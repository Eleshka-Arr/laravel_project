<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct(){ // регистрируем middleware в конструкторе, функция выполняется всегда в момент инициализации класса контроллера (когда объект контроллера создается, эта функция начинает выполняться)
        $this->middleware('throttle:10'); //'token', регистрируем middleware, он применяется на все методы в контроллере, выводит статус 429 yo many requests, на все методы в контроллере будет применяться, ->only() - конкретный метод
    }
    public function __invoke()
    {
        return 'Test';
    }
}
