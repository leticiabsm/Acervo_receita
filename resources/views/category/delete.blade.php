@extends('layouts.main')

@section('title', 'Editar Categoria')

@section('content')
<div class="container">
    <h1>Desativar Categoria</h1>

    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="nome" class="form-label">Categoria</label>
        <input type="text" name="nome" id="nome" class="form-control"
               value="{{ old('nome', $category->nome) }}" required readonly>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="3" readonly>{{ old('descricao', $category->descricao) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Ativo?</label>
        <select name="ind_ativo" class="form-select" required disabled>
            <option value="1" {{ $category->ind_ativo ? 'selected' : '' }}>ATIVO</option>
            <option value="0" {{ !$category->ind_ativo ? 'selected' : '' }}>INATIVO</option>
        </select>
    </div>

    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja desativar esta categoria?')">Desativar</button>
    <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

</div>
@endsection