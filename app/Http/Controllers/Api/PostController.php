<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
   /* public function __construct(){ // регистрируем middleware в конструкторе, функция выполняется всегда в момент инициализации класса контроллера (когда объект контроллера создается, эта функция начинает выполняться)
        $this->middleware('token')->only('index'); // регистрируем middleware, он применяется на все методы в контроллере (маршруты), или ->only('index') конкретные методы
        $this->middleware('token2')->except('store'); // ->except('store') для всех методов, исключая store
    }*/

    public function index()
    {
        return 'Страница список постов';
    }

    public function create()
    {
        return 'Страница создание поста';
    }

    public function store()
    {
        return 'Запрос создание поста';
    }

    public function show($post)  //переменная id поста
    {
        return "Страница просмотр поста {$post}";
    }

    public function edit($post)
    {
        return "Страница изменение поста {$post}";
    }

    public function update()
    {
        return 'Запрос обновление поста';
    }

    public function delete()
    {
        return 'Запрос удаление поста';
    }

    public function like()
    {
        return 'Лайк + 1';
    }

}
