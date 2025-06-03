<?php
use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\MedidaController; // Importe o novo controlador

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the ServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rotas para Ingredientes (já existentes)
Route::resource('ingredientes', IngredienteController::class);

// Novas Rotas para Medidas
Route::resource('medidas', MedidaController::class); // Esta linha cria todas as rotas CRUD para medidas
// Rotas para Receitas
Route::resource('receitas', ReceitaController::class);