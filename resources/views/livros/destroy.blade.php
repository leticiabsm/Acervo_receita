@extends('layouts.livro')

@section('title', 'Excluir Livro')

@section('content')
    <div class="content-wrapper">
        <h2>Exclusão de Livro</h2>
    </div>   
    
    <div class="container bg-white p-4 rounded shadow-lg">
        <div class="row">
            <!-- Primeira coluna -->
            <div class="col-md-4">
                <img src="{{ asset('img/livro_comida_caseira.jpeg') }}" alt="Livro" class="img-fluid mb-3 rounded">

                <div class="mb-3">
                    <p><strong>{{ $livro->titulo }}</strong></p>
                </div>
                <div class="mb-3">
                    <p><span>Editor Responsável: </span>{{ $livro->editor }}</p>
                </div>
                <div class="mb-3">
                    <p><span>ISBN: </span>{{ $livro->isbn }}</p>
                </div>
                <div class="mb-3">
                    <p><span>Nome Cozinheiro: </span>{{ $livro->cozinheiro }}</p>
                </div>
                <div class="mb-3">
                    <p><span>Nome Fantasia: </span>{{ $livro->nome_fantasia }}</p>
                </div>
            </div>
            
            <!-- Segunda coluna -->
            <div class="col-md-4 d-flex flex-column align-items-center border-end border-gray">
                <p>Prévia</p>
                <img src="{{ asset('img/img_comida_caseira.jpeg') }}" alt="imagem comida caseira" class="img-fluid mb-3">

                <div class="w-100 mt-4 p-3 border rounded bg-light">
                    <label for="comentario" class="form-label fw-bold">Comentário</label>
                    <textarea id="comentario" name="comentario" class="form-control" rows="6"
                        placeholder="Escreva aqui seu comentário sobre o livro, observações ou anotações importantes..."></textarea>
                </div>
            </div>


            <!-- Terceira coluna -->
            <div class="col-md-4 d-flex flex-column align-items-center">
                <p>Receitas incluídas</p>
                <ul>
                    @forelse ($livro->receitas as $receita)
                        <li>{{ $receita->titulo }}</li>
                    @empty
                        <li>Nenhuma receita cadastrada neste livro.</li>
                    @endforelse
                </ul>

                <form action="{{ route('livros.destroy', $livro->idlivro) }}" method="POST" class="d-flex flex-column align-items-center gap-2 w-100 mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-75">Excluir</button>
                    <a href="{{ route('livros.index') }}" class="btn btn-secondary w-75">Voltar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
