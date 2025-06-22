@extends('layouts.ingrediente')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detalhes do Ingrediente</h1>

    <div class="p-4 rounded" style="background-color: #f9f9f9; border: 1px solid #e0e0e0;">
        <p><strong>Nome:</strong> {{ $ingrediente->nome }}</p>
        <p><strong>Descrição:</strong> {{ $ingrediente->descricao ?? 'N/A' }}</p>
        <p><strong>Criado em:</strong> {{ $ingrediente->created_at?->format('d/m/Y H:i:s') ?? '-' }}</p>
        <p><strong>Última Atualização:</strong> {{ $ingrediente->updated_at?->format('d/m/Y H:i:s') ?? '-' }}</p>
    </div>

    <div class="btn-group mt-4" role="group" aria-label="Ações">
        <a href="{{ route('ingredientes.edit', $ingrediente->idIngrediente) }}" class="btn btn-warning">Editar</a>

        <form action="{{ route('ingredientes.destroy', $ingrediente->idIngrediente) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Tem certeza que deseja excluir este ingrediente?')">
                Excluir
            </button>
        </form>

        <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Voltar para a Lista</a>
    </div>
</div>
@endsection
