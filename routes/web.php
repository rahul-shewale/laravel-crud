<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');

Route::PUT('/products/update/{id}', [ProductController::class, 'update']);
Route::delete('/products/delete/{id}', [ProductController::class, 'destroy']);


Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');

// Route::get('/products/harddelete', [ProductController::class, 'harddelete'])->name('products.harddelete');