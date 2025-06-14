<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\MedidaController;

// Página inicial redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas de Autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'showCadastroForm'])->name('cadastro.form');
Route::post('/cadastro', [AuthController::class, 'cadastrarFuncionario'])->name('cadastro.salvar');
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Rotas protegidas
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard', fn() => redirect()->route('dashboard.admin'))->name('dashboard');

    // Cargos
    Route::resource('cargos', CargoController::class);

    Route::get('/cargos/{id}/status', [CargoController::class, 'status'])->name('cargos.status');
    Route::put('/cargos/{id}/status', [CargoController::class, 'atualizarStatus'])->name('cargos.atualizarStatus');


    // Funcionários

    Route::post('/funcionarios/{id}/inativar', [FuncionarioController::class, 'inativar'])->name('funcionarios.inativar');


    Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');
    Route::get('/funcionarios/{id}', [FuncionarioController::class, 'show'])->name('funcionarios.show');
    Route::get('/funcionarios/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
    Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
    Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

    Route::post('/funcionarios/{id}/reativar', [FuncionarioController::class, 'reativar'])->name('funcionarios.reativar');

    Route::get('/funcionarios/{id}/confirmar-exclusao', [FuncionarioController::class, 'confirmDelete'])->name('funcionarios.confirmDelete');
    Route::get('/funcionarios-lista', [FuncionarioController::class, 'index'])->name('funcionarios.lista');




    // Livros
    Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/livros/create', [LivroController::class, 'create'])->name('livros.create');
    Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
    Route::get('/livros/{titulo}', [LivroController::class, 'show'])->name('livros.show');
    Route::get('/livros/{titulo}/edit', [LivroController::class, 'edit'])->name('livros.edit');
    Route::put('/livros/{titulo}', [LivroController::class, 'update'])->name('livros.update');
    Route::delete('/livros/{titulo}', [LivroController::class, 'destroy'])->name('livros.destroy');

    // Ingredientes, Medidas e Receitas
    Route::resource('ingredientes', IngredienteController::class);
    Route::resource('medidas', MedidaController::class);
    Route::resource('receitas', ReceitaController::class);
});
