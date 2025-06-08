@extends('layouts.categoria')

@section('title', 'Editar Categoria')

@section('content')
    <div class="container my-5">
        <div class="text-center mb-4">
            <h2>Editar Categoria</h2>
        </div>

        <div class="card shadow mx-auto p-4" style="max-width: 500px;">
            <form action="{{ route('category.update', $category->idCategoria) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome da Categoria</label>
                    <input type="text" name="nome_categoria" id="nome" class="form-control" required value="{{ old('nome_categoria', $category->nome_categoria) }}">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label fw-bold">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao', $category->descricao) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="ind_ativo" class="form-label fw-bold">Status</label>
                    <select name="ind_ativo" id="ind_ativo" class="form-select" required>
                        <option value="1" {{ $category->ind_ativo ? 'selected' : '' }}>ATIVO</option>
                        <option value="0" {{ !$category->ind_ativo ? 'selected' : '' }}>INATIVO</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">EDITAR</button>
                    <a href="{{ route('category.index') }}" class="btn btn-secondary">VOLTAR</a>
                </div>
            </form>
        </div>
    </div>
@endsection
