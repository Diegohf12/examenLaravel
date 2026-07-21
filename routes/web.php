<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/');

Route::get('/productos', function () {
    return view('productos.index');
})->middleware('auth');

Route::get('/categorias', function () {
    return view('categorias.index');
})->middleware('auth');

Route::get('/proveedores', function () {
    return view('proveedores.index');
})->middleware('auth');