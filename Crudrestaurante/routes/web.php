<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestauranteController;

Route::get('/', [RestauranteController::class, 'index']);
Route::resource('restaurantes', RestauranteController::class);
