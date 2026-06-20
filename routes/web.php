<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("home.about");
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name("product.index");
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name("product.show");

Route::middleware('auth')->group(function () {
    Route::get('/cart', 'App\Http\Controllers\CartController@index')->name("cart.index");
    Route::post('/cart', 'App\Http\Controllers\CartController@add')->name("cart.add");
    Route::delete('/cart/{id}', 'App\Http\Controllers\CartController@remove')->name("cart.remove");
    Route::post('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name("cart.purchase");
    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name("order.index");
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin\AdminController@index')->name("admin.index");
    Route::get('/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");
    Route::post('/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name("admin.product.store");
    Route::delete('/products/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name("admin.product.delete");
    Route::get('/products/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name("admin.product.edit");
    Route::put('/products/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name("admin.product.update");
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');