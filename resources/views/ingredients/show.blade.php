@extends('layouts.app')

@section('content')
    <h2>Detalhes do Ingrediente</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nome: {{ $ingredient->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $ingredient->id }}</p>
            <p class="card-text"><strong>Criado em:</strong> {{ $ingredient->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Atualizado em:</strong> {{ $ingredient->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('ingredients.index') }}" class="btn btn-primary">Voltar para a lista</a>
        <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este ingrediente?')">Excluir</button>
        </form>
    </div>
@endsection