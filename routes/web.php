<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;


Route::get('/', function () {
    return view('welcome');
});


// Rotas para o CRUD de Cargos
// use App\Http\Controllers\CargoController;
Route::resource('cargos', CargoController::class);
