<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DegustacaoController;
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
use App\Http\Controllers\LivroPublicadoController;
use App\Http\Controllers\LivroDownloadController;
use App\Http\Controllers\CozinheiroController;
use App\Http\Controllers\DegustadorController;

// Página inicial redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

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
    Route::get('/dashboard/editor', [DashboardController::class, 'dashboardEditor'])->name('dashboard.editor');
    Route::get('/dashboard/cozinheiro', [CozinheiroController::class, 'dashboard'])->name('dashboard.cozinheiro');
    Route::get('/dashboard/degustador', [DegustadorController::class, 'dashboard'])->name('dashboard.degustador'); // Rota para o dashboard do degustador

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
    Route::get('/categorias/{id}/destroy', [CategoriaController::class, 'delete'])->name('categorias.destroy.view'); // Mostra a tela de confirmação

    // Receitas
    Route::resource('receitas', ReceitaController::class);

    // Medidas
    Route::resource('medidas', MedidaController::class);

    // Ingredientes
    Route::resource('ingredientes', IngredienteController::class);

    // Livros (usando idlivro como parâmetro)
    Route::get('/livros/{idlivro}/destroy', [LivroController::class, 'destroyView'])->name('livros.destroy.view');
    Route::resource('livros', LivroController::class)->parameters([
        'livros' => 'idlivro'
    ]);
    Route::get('/livros/{idlivro}/download', [LivroController::class, 'download'])->name('livros.download');
    Route::resource('livros', LivroController::class)->parameters(['livros' => 'idlivro']);
    Route::get('/livros/{idlivro}/deletar', [LivroController::class, 'destroyView'])->name('livros.destroy.view');

    // Restaurantes
    Route::resource('restaurantes', RestauranteController::class);

    // Painel do Editor
    Route::get('/dashboard/editor', [\App\Http\Controllers\EditorController::class, 'dashboard'])->name('dashboard.editor');

    // Livros Publicados
    Route::resource('publicacao', LivroPublicadoController::class);
    Route::post('/livros/{idlivro}/publicar', [LivroController::class, 'publicar'])->name('livros.publicar');

    Route::get('/publicacao/{id}/visualizar', [LivroPublicadoController::class, 'visualizar'])->name('publicacao.visualizar');

    Route::post('/livros/{idlivro}/publicar', [LivroController::class, 'publicar'])->name('livros.publicar');
    Route::get('/publicacao/{id}', [LivroPublicadoController::class, 'show'])->name('publicacao.show');
    Route::get('/publicacao/{id}/pdf', [LivroPublicadoController::class, 'pdf'])->name('publicacao.pdf');


    // Degustação (fora do grupo de autenticação)
    Route::get('/degustacao', [DegustacaoController::class, 'index'])->name('degustacao.index');
    Route::get('/degustacao/search', [DegustacaoController::class, 'search'])->name('degustacao.search');
    Route::get('/degustacao/create', [DegustacaoController::class, 'create'])->name('degustacao.create');
    Route::post('/degustacao', [DegustacaoController::class, 'store'])->name('degustacao.store');
    Route::get('/degustacao/{id}/edit', [DegustacaoController::class, 'edit'])->name('degustacao.edit');
    Route::put('/degustacao/{id}', [DegustacaoController::class, 'update'])->name('degustacao.update');
    Route::delete('/degustacao/{id}', [DegustacaoController::class, 'destroy'])->name('degustacao.destroy');
    Route::get('/degustacao/{id}', [DegustacaoController::class, 'show'])->name('degustacao.show');
});
