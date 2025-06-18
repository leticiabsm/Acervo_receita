<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DegustacaoController;
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

    // Dashboard para Editor
    Route::get('/dashboard/editor', [DashboardController::class, 'editor'])->name('dashboard.editor');

    // Cargos
    Route::resource('cargos', CargoController::class);

    Route::get('/cargos/{id}/status', [CargoController::class, 'status'])->name('cargos.status');
    Route::put('/cargos/{id}/status', [CargoController::class, 'atualizarStatus'])->name('cargos.atualizarStatus');


    // Funcionários
    Route::resource('funcionarios', FuncionarioController::class);

    Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');

    Route::get('/funcionarios/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');

    Route::get('funcionarios/{id}/delete', [FuncionarioController::class, 'confirmDelete'])->name('funcionarios.delete');
    Route::post('funcionarios/{id}/inativar', [FuncionarioController::class, 'inativar'])->name('funcionarios.inativar');
    Route::post('funcionarios/{id}/reativar', [FuncionarioController::class, 'reativar'])->name('funcionarios.reativar');




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


Route::get('/degustacao', [DegustacaoController::class, 'index'])->name('degustacao.index');


Route::get('/degustacao/search', [DegustacaoController::class, 'search'])->name('degustacao.search');
Route::get('/degustacao/create', [DegustacaoController::class, 'create'])->name('degustacao.create');
Route::post('/degustacao', [DegustacaoController::class, 'store'])->name('degustacao.store');


Route::get('/degustacao/{id}/edit', [DegustacaoController::class, 'edit'])->name('degustacao.edit');
Route::put('/degustacao/{id}', [DegustacaoController::class, 'update'])->name('degustacao.update');

Route::get('/degustacao/{id}/delete', [DegustacaoController::class, 'delete'])->name('degustacao.delete');
Route::delete('/degustacao/{id}/destroy', [DegustacaoController::class, 'destroy'])->name('degustacao.destroy');

Route::get('/degustacao/{id}', [DegustacaoController::class,'show'])->name('degustacao.show');
