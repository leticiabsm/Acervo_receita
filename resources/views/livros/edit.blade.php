@extends('layouts.livro')
@section('title', 'Editar')

@section('content')
<div class="content-wrapper text-center mb-4">
    <h2 class="text-white">Editar Livro</h2>
</div>

<div class="container bg-light p-4 rounded shadow-lg">
    <form action="{{ route('livros.update', $livro->idlivro) }}" method="POST" enctype="multipart/form-data" class="w-100">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- Coluna 1: Dados do Livro --}}
            <div class="col-md-4">
                <img src="{{ asset('img/livro_comida_caseira.jpeg') }}" alt="Livro" class="img-fluid mb-3 rounded">

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" required value="{{ $livro->titulo }}">
                </div>
                <div class="mb-3">
                    <label for="editor" class="form-label">Editor Responsável:</label>
                    <input type="text" name="editor" id="editor" class="form-control" required value="{{ $livro->editor }}">
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN:</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" required pattern="\d{3}-\d-\d{3}-\d{5}-\d" value="{{ $livro->isbn }}">
                </div>
                <div class="mb-3">
                    <label for="cozinheiro" class="form-label">Nome do Cozinheiro:</label>
                    <input type="text" name="cozinheiro" id="cozinheiro" class="form-control" required value="{{ $livro->cozinheiro }}">
                </div>
                <div class="mb-3">
                    <label for="nome_fantasia" class="form-label">Nome Fantasia (Cozinheiro):</label>
                    <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" value="{{ $livro->nome_fantasia }}">
                </div>
                <div class="mb-3">
                    <label for="capa_livro" class="form-label">Alterar Capa:</label>
                    <input type="file" name="capa_livro" id="capa_livro" class="form-control">
                </div>
            </div>

            {{-- Coluna 2: Texto do Livro e Imagem --}}
            <div class="col-md-4 border-start border-end">
                <div class="mb-3">
                    <label for="texto_livro" class="form-label">Texto do Livro:</label>
                    <textarea name="texto_livro" id="texto_livro" class="form-control" rows="10" placeholder="Escreva o conteúdo do livro aqui...">{{ $livro->texto_livro }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="imagem_livro" class="form-label">Alterar Imagem Ilustrativa:</label>
                    <input type="file" name="imagem_livro" id="imagem_livro" class="form-control">
                </div>
            </div>

            {{-- Coluna 3: Botões --}}
            <div class="col-md-4 ps-4" style="position:relative;">
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection