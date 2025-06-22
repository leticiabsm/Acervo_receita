
@extends('layouts.medidas')

@section('title', 'Detalhes da Medida')

@section('content')
<div class="container">
    <h1>Detalhes da Medida</h1>

    <div class="details-box">
        <p><strong>Descrição:</strong> {{ $medida->descricao }}</p>
        <p><strong>Tipo:</strong> {{ $medida->tipo }}</p>
        <p><strong>Item:</strong> {{ $medida->item }}</p>
        <p><strong>Status:</strong> {{ $medida->ind_ativo ? 'Ativo' : 'Inativo' }}</p>
    </div>

    <div class="btn-group mt-4">
        <a href="{{ route('medidas.edit', $medida->idMedida) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('medidas.destroy', $medida->idMedida) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta medida?')">Excluir</button>
        </form>
        <a href="{{ route('medidas.index') }}" class="btn btn-secondary">Voltar para a Lista</a>
    </div>
</div>
@endsection
