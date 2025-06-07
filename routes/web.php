<?php
<<<<<<< HEAD
use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\categoryController;
use App\Http\Controllers\Controller;


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
//Route::get('/', [RestauranteController::class, 'index']);
Route::resource('restaurantes', RestauranteController::class);

// Rotas para Categorias
Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', [categoryController::class, 'index'])->name('category.index');

Route::get('/category/create', [categoryController::class, 'create'])->name('category.create');
Route::post('/categories', [categoryController::class, 'store'])->name('category.store');

Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

Route::get('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
Route::delete('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/category/{id}/show', [CategoryController::class, 'show'])->name('category.show');
