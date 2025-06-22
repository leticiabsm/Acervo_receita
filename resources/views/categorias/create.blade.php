@extends('layouts.categorias')
@section('title', 'Categorias')
@section('content')
<div class="container my-5">
    <div class="text-center mb-4">
        <h2>Adicionar Categoria</h2>
    </div>

    <div class="card shadow mx-auto p-4" style="max-width: 500px;">
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label fw-bold">Nome da Categoria</label>
                <input type="text" name="nome_cat" id="nome" class="form-control" required value="{{ old('nome_cat') }}">
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label fw-bold">Descrição</label>
                <textarea name="desc" id="descricao" class="form-control" rows="3">{{ old('desc') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="ind_ativo" class="form-label fw-bold">Status</label>
                <select name="ind_ativo" id="ind_ativo" class="form-select">
                    <option value="1" {{ old('ind_ativo') == '1' ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ old('ind_ativo') == '0' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>


            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Adicionar</button>
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>
@endsection