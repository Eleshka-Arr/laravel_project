<?php

//admin
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(  'auth','active', 'admin')->group(function(){  //

    Route::redirect('/', '/admin/posts')->name('admin');

    // CRUD (create, read, update, delete) // операции над ресурсами // есть стандартный набор маршрутов, который реализует функционал работы над ресурсами
    // Чтобы указать метод в контроллере, нужно поместить его в массив, а вторым элементом указать метод контроллера + название метода ->name
    //посты
    Route::get('posts', [PostController::class, 'index'])->name('admin.posts.index'); // ->middleware('role:writer') - передаем параметры в middleware проверка роли писатель
    Route::get('posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show'); //->whereAlpha() - только цифры, ->whereNumber('post') - только число
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('posts/{post}', [PostController::class, 'delete'])->name('admin.posts.delete');


    // лайки
    Route::put('posts/{post}/like', [PostController::class, 'like'])->name('admin.posts.like'); // количество лайков увеличиваем на 1 (likes_count + 1) post или put

});
