<?php

//user (создаем группу для маршрутов) все что относится к пользователю авторизация, регистрация, посты (->as('user.')) для всех name префикс user.
use App\Http\Controllers\User\PostController;
use Illuminate\Support\Facades\Route;
// /user
// /user/posts
// /user/posts/create
Route::prefix('user')->middleware(['auth', 'active'])->as('user.')->group(function(){ // ->middleware('auth') применяем middleware аутентификации на группу

    // CRUD (create, read, update, delete) // операции над ресурсами // есть стандартный набор маршрутов, который реализует функционал работы над ресурсами
    // Чтобы указать метод в контроллере, нужно поместить его в массив, а вторым элементом указать метод контроллера + название метода ->name
    //посты
    Route::redirect('/', '/user/posts')->name('user');  // Route::get('/')->name('user') главный маршрут user,  можно добавить userController, который будет возвращать пользователю страницу в кабинете, или перекинем сразу на user/posts

    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show'); //->whereAlpha() - только цифры, ->whereNumber('post') - только число
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'delete'])->name('posts.delete');


    // лайки
    Route::put('posts/{post}/like', [PostController::class, 'like'])->name('posts.like'); // количество лайков увеличиваем на 1 (likes_count + 1) post или put

});
