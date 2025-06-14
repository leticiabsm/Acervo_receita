@extends('layouts.categoria')
@section('title', 'Desativar Categoria')

@section('content')
    <div class="container my-5">
        <div class="text-center mb-4">
            <h2>Desativar Categoria</h2>
        </div>

        <div class="card shadow mx-auto p-4" style="max-width: 500px;">
            <form action="{{ route('category.destroy', $category->idCategoria) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nome da Categoria</label>
                    <input type="text" class="form-control" value="{{ $category->nome_categoria }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Descrição</label>
                    <textarea class="form-control" rows="3" readonly>{{ $category->descricao }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <input type="text" class="form-control"
                        value="{{ $category->ind_ativo ? 'ATIVO' : 'INATIVO' }}" readonly>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Tem certeza que deseja desativar esta categoria?')">Desativar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
