<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

// esto es para usar un componente livewire directo como un controlador
use App\Http\Livewire\ShowPosts;
use App\Http\Livewire\Admin\Categories;

Route::get('/',[PostController::class,'index'])->name('posts.index');

// esta ruta es para ver el detalle de un post
// al usar la ruta de esta manera estamos enviando el objeto mismo como parametro, en la URL muestra blog.test/posts/65 por ejempllo
//Route::get('posts/{post}',[PostController::class,'show'])->name('posts.show');

// al enviar {posts/{post:slug}, estamos diciendole a laravel que muestre el valor del campo slug en la URL
Route::get('posts/{post:slug}',[PostController::class,'show'])->name('posts.show');
Route::get('category/{category:slug}',[PostController::class,'category'])->name('posts.category');
Route::get('tag/{tag}',[PostController::class,'tag'])->name('posts.tag');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// de esta forma estamos usando un componente livewire como un controlador, de hecho en este momento el controller normal
// es reemplazado por este componente, ver lista de rutas php artisan route:l
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', ShowPosts::class)->name('dashboard');

Route::get('categories', Categories::class)->name('categories');

// de esta forma creamos una ruta a un metodo en especifico
//route::get('prueba/{name}',[ShowPosts::class, 'listar']);
//route::get('prueba/{name}', ShowPosts::class);
