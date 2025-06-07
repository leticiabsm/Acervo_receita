<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdmController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\FuncionarioController;

use App\Http\Controllers\ReceitaController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;

use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\MedidaController; // Importe o novo controlador


// Página inicial (login)
Route::get('/', function () {
    return view('auth.login');
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
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');

Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');

Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

Route::get('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
Route::delete('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/category/{id}/show', [CategoryController::class, 'show'])->name('category.show');





// Rotas de Autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'showCadastroForm'])->name('cadastro.form');
Route::post('/cadastro', [AuthController::class, 'cadastrarFuncionario'])->name('cadastro.salvar');
Route::post('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');

// Dashboard (painel principal)
Route::get('/dashboard', [DashboardAdmController::class, 'dashboardAdm'])->name('dashboard');

// Rotas de Cargos
Route::prefix('cargos')->name('cargos.')->group(function () {
    Route::get('/', [CargoController::class, 'index'])->name('lista');
    Route::get('/adicionar', [CargoController::class, 'showAdicionar'])->name('adicionar');
    Route::post('/salvar', [CargoController::class, 'salvar'])->name('salvar');
});

// Rotas de Funcionários (CRUD)
Route::prefix('funcionarios')->name('funcionarios.')->group(function () {
    Route::get('/', [FuncionarioController::class, 'index'])->name('lista');
    Route::get('/create', [FuncionarioController::class, 'create'])->name('create');
    Route::post('/', [FuncionarioController::class, 'store'])->name('store');
    Route::get('/{id}', [FuncionarioController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [FuncionarioController::class, 'edit'])->name('edit');
    Route::put('/{id}', [FuncionarioController::class, 'update'])->name('update');
    Route::get('/{id}/confirmDelete', [FuncionarioController::class, 'confirmDelete'])->name('confirmDelete');

    // Desativar (inativar) funcionário
    Route::post('/{id}/desativar', [FuncionarioController::class, 'destroy'])->name('destroy');

    // Reativar funcionário
    Route::post('/{id}/reativar', [FuncionarioController::class, 'reativar'])->name('reativar');
    

});

