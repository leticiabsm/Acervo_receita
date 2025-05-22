@extends('layouts.app')

@section('content')
    <h2>Detalhes da Medida</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nome: {{ $measure->name }}</h5>
            <p class="card-text"><strong>Abreviação:</strong> {{ $measure->abbreviation ?? 'N/A' }}</p>
            <p class="card-text"><strong>ID:</strong> {{ $measure->id }}</p>
            <p class="card-text"><strong>Criado em:</strong> {{ $measure->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Atualizado em:</strong> {{ $measure->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('measures.index') }}" class="btn btn-primary">Voltar para a lista</a>
        <a href="{{ route('measures.edit', $measure->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('measures.destroy', $measure->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta medida?')">Excluir</button>
        </form>
    </div>
@endsection