@extends('layouts.livro') {{-- Ou outro layout, se preferir: layouts.publicacao --}}

@section('content')
<div class="content-wrapper text-center mb-4">
    <h2 class="text-white">Adicionar Publicação</h2>
</div>

<div class="container bg-light p-4 rounded shadow-lg">
    <form action="{{ route('publicacao.store') }}" method="POST" enctype="multipart/form-data" class="w-100">
        @csrf
        <div class="row">
            {{-- Coluna 1: Informações da Publicação --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título da Publicação:</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Editor:</label>
                    <input type="text" name="autor" id="autor" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria:</label>
                    <select name="categoria" id="categoria" class="form-select" required>
                        <option value="">Selecione...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem de Capa:</label>
                    <input type="file" name="imagem" id="imagem" class="form-control">
                </div>
            </div>

            {{-- Coluna 2: Conteúdo da Publicação --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="conteudo" class="form-label">Conteúdo:</label>
                    <textarea name="conteudo" id="conteudo" class="form-control" rows="12" placeholder="Escreva o conteúdo aqui..." required></textarea>
                </div>
            </div>
        </div>

        {{-- Botões --}}
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">Publicar</button>
            <a href="{{ route('publicacao.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
