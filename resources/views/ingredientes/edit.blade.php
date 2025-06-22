@extends('layouts.ingrediente')

@section('content')
<div class="container mt-5">
    <h1>Editar Ingrediente</h1>

    <form action="{{ route('ingredientes.update', $ingrediente->idIngrediente) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $ingrediente->nome) }}" required>
            @error('nome')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição (Opcional):</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="5">{{ old('descricao', $ingrediente->descricao) }}</textarea>
            @error('descricao')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
