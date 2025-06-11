<?php

use App\Http\Controllers\DegustacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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