@extends('layouts.livro')

@section('title', 'Show')

@section('content')
    <div class="content-wrapper">
        <h2>Consulta de Livro</h2>
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
            <div class="col-md-4 d-flex flex-column align-items-center border-right border-gray">
                <p>Prévia</p>
                <img src="{{ asset('img/img_comida_caseira.jpeg') }}" alt="imagem comida caseira" class="img-fluid mb-3">
                <label class="text" for="comentario">Adicione um comentario</label>
                <input type="text" id="comentario" name="comentario" placeholder="Escreva um comentário sobre o livro">
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
                <a href="{{ route('livros.index') }}" class="btn btn-secondary">VOLTAR</a>
            </div>
        </div>
    </div>
@endsection