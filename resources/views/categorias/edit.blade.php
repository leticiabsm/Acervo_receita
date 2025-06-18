@extends('layouts.categorias')

@section('title', 'Editar Categoria')

@section('content')
    <div class="container my-5">
        <div class="text-center mb-4">
            <h2 class="text-white">Editar Categoria</h2>
        </div>

        <div class="card shadow mx-auto p-4" style="max-width: 500px;">
            <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome da Categoria</label>
                    <input type="text" name="nome_categoria" id="nome" class="form-control" required value="{{ old('nome_categoria', $categoria->nome_cat) }}">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label fw-bold">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao', $categoria->desc) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="ind_ativo" class="form-label fw-bold">Status</label>
                    <select name="ind_ativo" id="ind_ativo" class="form-select" required>
                        <option value="1" {{ $categoria->ativo ? 'selected' : '' }}>ATIVO</option>
                        <option value="0" {{ !$categoria->ativo ? 'selected' : '' }}>INATIVO</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">EDITAR</button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">VOLTAR</a>
                </div>
            </form>
        </div>
    </div>
@endsection
