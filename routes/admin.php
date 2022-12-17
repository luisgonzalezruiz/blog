<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

use Illuminate\Support\Facades\Route;

// con el middleware protegemos la ruta, es decir con spatie protegemos las vistas y de esta forma la ruta
Route::get('/',[HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');

//tener en cuenta que cuando le damos nombre a las rutas y si esta es tipo resource usamos "names" plural
Route::resource('users', UserController::class)->only(['index','edit','create','destroy','update'])->names('admin.users');

Route::resource('roles', RoleController::class)->names('admin.roles');

// note names(de esta forma le decimos como empienzan las rutas)
// este resource se usa para generar las rutas clasicas para los 7 metodos
// create, store, index, edit, show, destroy, update
// ejemplo de como le llamamos route(''admin.categories.store)
Route::resource('categories', CategoryController::class)->names('admin.categories');

Route::resource('tags', TagController::class)->except('show')->names('admin.tags');

Route::resource('posts', PostController::class)->names('admin.posts');
