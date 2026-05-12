<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);

Route::get('/insert', [App\Http\Controllers\ProductController::class, 'insert']);
Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit']);
Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::get('/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete']);

// Form Create & Store
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create']);
Route::post('/products/store', [App\Http\Controllers\ProductController::class, 'store']);