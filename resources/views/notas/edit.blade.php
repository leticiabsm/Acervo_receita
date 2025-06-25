@extends('layouts.nota')

@section('title', 'Editar Degustação')

@section('content')
<div class="container my-5">
    <h3>Editar Degustação</h3>
    <div class="card p-4">
        <form action="{{ route('degustacao.update', $degustacao->idDesgustacao) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nota_degustacao" class="form-label">Nota da Degustação</label>
                <input type="number" name="nota_degustacao" id="nota_degustacao" class="form-control"
                       value="{{ $degustacao->nota_degustacao }}" min="0" max="10" step="0.5" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Comentário</label>
                <textarea name="descricao" id="descricao" rows="4" class="form-control" required>{{ $degustacao->descricao }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('degustacao.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
