<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

Route::get('/', function () {
    return redirect()->route('livros.index');
});

Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
Route::get('/livros/create', [LivroController::class, 'create'])->name('livros.create');
Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
Route::get('/livros/{titulo}', [LivroController::class, 'show'])->name('livros.show');
Route::get('/livros/{titulo}/edit', [LivroController::class, 'edit'])->name('livros.edit');
Route::put('/livros/{titulo}', [LivroController::class, 'update'])->name('livros.update');
Route::delete('livros/{titulo}',[LivroController::class, 'destroy'])->name('livros.destroy');


//Route::resource('livros', LivroController::class)->parameters([
 //  'livros' => 'titulo' // Define que o parâmetro será "titulo" ao invés do ID
//]); Inclui index, create, store, show, edit, update e destroy, sem precisar definir cada uma manualmente
