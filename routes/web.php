<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);

Route::get('/insert', [App\Http\Controllers\ProductController::class, 'insert']);
Route::get('/update/{id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::get('/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete']);