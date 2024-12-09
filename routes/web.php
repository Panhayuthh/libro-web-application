<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/history', [OrderController::class, 'history'])->name('history')->middleware('auth');
Route::get('/menu', [MenuItemController::class, 'index'])->name('menu');

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'store'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'menu', 'middleware' => ['auth','can:add-to-cart']], function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'createCartItem'])->name('createCartItem');
    Route::patch('/cart/{cartItem}', [CartController::class, 'updateCartItem'])->name('updateCartItem');
    Route::delete('/cart/{cart}', [CartController::class, 'destroyCart'])->name('destroyCart');
    Route::delete('/cart/item/{cartItem}', [CartController::class, 'destroyCartItem'])->name('destroyCartItem');
});

Route::group(['prefix' => 'order', 'middleware' => ['auth','can:add-to-cart']], function () {
    Route::get('/', [OrderController::class, 'index'])->name('order');
    Route::post('/', [OrderController::class, 'store'])->name('order.store');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','is_admin']], function() {
    Route::get('/dashboard', [adminController::class, 'index'])->name('admin.dashboard');
    Route::post('/menu/create', [adminController::class, 'store'])->name('menu.store');
    Route::get('/menu/{menuItem}/edit', [adminController::class, 'edit']);
    Route::put('/menu/{menuItem}/edit', [adminController::class, 'update']);
    Route::delete('/menu/{menuItem}', [adminController::class, 'destroy']);
});

// Route::get('/cart', [CartController::class, 'show'])->name('cart');