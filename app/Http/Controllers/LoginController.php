<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index'); // страница входа, view() - функция хелпер
    }

    public function store()
    {
        return 'Запрос на вход';
    }
}
