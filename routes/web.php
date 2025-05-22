<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GmgIngredienteController;
use App\Http\Controllers\GmgMedidaController;

Route::get('/', function () {
    return view('welcome');
});

// CORREÇÃO AQUI: Use o nome da classe do controlador correto.
// Se sua classe é 'GmgIngredienteController', use GmgIngredienteController::class
Route::resource('gmg_ingredientes', GmgIngredienteController::class);

// CORREÇÃO AQUI: Use o nome da classe do controlador correto.
// Se sua classe é 'GmgMedidaController', use GmgMedidaController::class
Route::resource('gmg_medidas', GmgMedidaController::class);