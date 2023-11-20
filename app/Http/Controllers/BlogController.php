<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BlogController extends Controller
{
    public function index()
    {
        //return Route::is('blog.index') ? 'yes' : 'no'; // проверка является ли маршрут blog.index
        return 'Посты в блоге';
    }

    public function show($post)
    {
        //return Route::is('blog*') ? 'yes' : 'no';  // проверка является ли маршрут blog*
        return "Один пост в блоге id поста: {$post}";
    }

    public function like($post)
    {
        return 'Поставить лайк';
    }
}
