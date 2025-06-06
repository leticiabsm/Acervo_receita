<?php
use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\MedidaController; // Importe o novo controlador


Route::get('/', function () {
    return redirect()->route('livros.index');
});

// Rotas para Livros
Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
Route::get('/livros/create', [LivroController::class, 'create'])->name('livros.create');
Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
Route::get('/livros/{titulo}', [LivroController::class, 'show'])->name('livros.show');
Route::get('/livros/{titulo}/edit', [LivroController::class, 'edit'])->name('livros.edit');
Route::put('/livros/{titulo}', [LivroController::class, 'update'])->name('livros.update');
Route::delete('livros/{titulo}',[LivroController::class, 'destroy'])->name('livros.destroy');

// Rotas para Ingredientes
Route::resource('ingredientes', IngredienteController::class);

// Novas Rotas para Medidas
Route::resource('medidas', MedidaController::class); 
// Rotas para Receitas
Route::resource('receitas', ReceitaController::class);

// Rotas para Restaurantes
Route::get('/', [RestauranteController::class, 'index']);
Route::resource('restaurantes', RestauranteController::class);
