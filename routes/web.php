<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\categoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', [categoryController::class, 'index'])->name('category.index');

Route::get('/category/create', [categoryController::class, 'create'])->name('category.create');
Route::post('/categories', [categoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
Route::put('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

