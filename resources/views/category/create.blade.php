@extends('layouts.app')
@section('title', 'categorias')
@section('content') 
    <div class="container my-5">
        <div class="text-center mb-4">
            <h2>Adicionar Categoria</h2>
        </div>

        <div class="card shadow mx-auto p-4" style="max-width: 500px;">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome da Categoria</label>
                    <input type="text" name="nome_categoria" id="nome" class="form-control" required value="{{ old('nome_categoria') }}">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label fw-bold">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">ADICIONAR</button>
                    <a href="{{ route('category.index') }}" class="btn btn-secondary">VOLTAR</a>
                </div>
            </form>
        </div>
    </div>
@endsection