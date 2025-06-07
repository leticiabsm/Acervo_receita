<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdmController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\FuncionarioController;

// Página inicial (login)
Route::get('/', function () {
    return view('auth.login');
});

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
