<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
//use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::view('/', 'home.index')->name('home');

Route::redirect('/home', '/', 302)->name('home.redirect');

// добавить в конец ->middleware(LogMiddleware::class) регистрация middleware + импорт сделать, ->middleware('test') - регистрация по названию группы, ->middleware('log') - алиас, импорт не нужен
Route::get('/test', TestController::class)->name('test')->middleware('token:secret'); //->middleware('token:secret') передаем параметр через : сразу сюда, но не секретные ключи, 'token:secret, foo' - 2 параметра передаем token, foo

// навешиваем middleware 'guest' на всю группу маршрутов авторизации и регистрации, вместо прописи ->middleware('guest') в конце каждого маршрута
Route::middleware('guest')->group(function (){

    // регистрация пользователя (если нет ресурсов пример)
    Route::get('register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    // авторизация пользователя
    Route::get('login', [LoginController::class, 'index'])->name('login.index')->withoutMiddleware('guest'); //->withoutMiddleware('guest') не хотим чтобы для страницы входа маршрут гость был, ->middleware('guest') направляем по маршруту middleware 'guest', который прописан aliases в app/http/kernel.php
    Route::post('login', [LoginController::class, 'store'])->name('login.store'); // ->withoutMiddleware() - без middleware, исключаем middleware из маршрута в группе Middleware guest не будет для маршрута 'login.store'
});

// подтверждение входа например по email (введите код отправленный по смс)
// страница подтверждения  (подтверждение)
Route::get('login/{user}/confirmation', [LoginController::class, 'confirmation'])->name('login.confirmation');
// подтвердить страница
Route::post('login/{user}/confirm', [LoginController::class, 'confirm'])->name('login.confirm');

Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::post('blog/{post}/likes', [BlogController::class, 'like'])->name('blog.like');


// комментарии
Route::resource('posts/{post}/comments', CommentController::class);//->except(['index', 'show',]);

/*Route::resource('posts', PostController::class)->only([
    'index', 'show',
]);*/

// Route::post('posts/{post}/comments', [PostController::class, 'comments'])->name('posts.comment'); // лучше сделать отдельный ресурс

//Route::delete('posts/{post}/likes', [PostController::class, 'delete'])->name('posts.delete'); // отдельная сущность лайки

// в самом низу
/*Route::fallback(function (){
    return 'Fallback';
});*/
