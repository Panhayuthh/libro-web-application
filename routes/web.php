<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\MenuItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'menu'], function () {
    Route::get('/', [MenuItemController::class, 'index']);
    Route::get('/{menuItem}', [MenuItemController::class, 'show']);
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('/dashboard', [adminController::class, 'index']);
    Route::get('/menu/create', [adminController::class, 'create']);
    Route::post('/menu/create', [adminController::class, 'store']); 
    Route::get('/menu/{menuItem}/edit', [adminController::class, 'edit']);
    Route::put('/menu/{menuItem}/edit', [adminController::class, 'update']);
    Route::delete('/menu/{menuItem}', [adminController::class, 'destroy']);
});