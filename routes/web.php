<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\MedidaController;

// Página inicial redireciona para login
Route::get('/', fn() => redirect()->route('login'));

// Autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'showCadastroForm'])->name('cadastro.form');
Route::post('/cadastro', [AuthController::class, 'cadastrarFuncionario'])->name('cadastro.salvar');
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {

    // Dashboards
    Route::get('/dashboard', fn() => redirect()->route('dashboard.admin'))->name('dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/editor', [DashboardController::class, 'editor'])->name('dashboard.editor');
    Route::get('/dashboard/cozinheiro', [DashboardController::class, 'cozinheiro'])->name('dashboard.cozinheiro');

    // Cargos
    Route::resource('cargos', CargoController::class);
    Route::get('/cargos/{id}/status', [CargoController::class, 'status'])->name('cargos.status');
    Route::put('/cargos/{id}/status', [CargoController::class, 'atualizarStatus'])->name('cargos.atualizarStatus');

    // Funcionários
    Route::resource('funcionarios', FuncionarioController::class);
    Route::get('funcionarios/{id}/delete', [FuncionarioController::class, 'confirmDelete'])->name('funcionarios.delete');
    Route::post('funcionarios/{id}/inativar', [FuncionarioController::class, 'inativar'])->name('funcionarios.inativar');
    Route::post('funcionarios/{id}/reativar', [FuncionarioController::class, 'reativar'])->name('funcionarios.reativar');

    // Categorias
    Route::resource('categorias', CategoriaController::class);

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::get('categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');

    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');



    // Receitas
    Route::resource('receitas', ReceitaController::class);

    // Medidas
    Route::resource('medidas', MedidaController::class)->only(['index', 'create']);

    // Ingredientes
    Route::resource('ingredientes', IngredienteController::class)->only(['index', 'create']);

    // Livros
    Route::resource('livros', LivroController::class)->parameters([
        'livros' => 'titulo' // permite que o nome usado seja o título do livro
    ]);

    // Restaurantes
    Route::resource('restaurantes', RestauranteController::class);

});
