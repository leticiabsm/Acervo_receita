<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\categoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', [categoryController::class, 'index']);
Route::get('/category/create', [categoryController::class, 'create']);