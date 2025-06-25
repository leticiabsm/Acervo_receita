@extends('layouts.nota')

@section('title', 'Detalhes da Degustação')

@section('content')
<div class="container my-5">
    <h3>Detalhes da Degustação</h3>
    <div class="card p-4">
        <p><strong>Receita:</strong> {{ $degustacao->receita->nome_rec }}</p>
        <p><strong>Nota:</strong> {{ $degustacao->nota_degustacao }}</p>
        <p><strong>Data:</strong> {{ $degustacao->data_degustacao }}</p>
        <p><strong>Comentário:</strong> {{ $degustacao->descricao }}</p>
        
        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('degustacao.edit', $degustacao->idDesgustacao) }}" class="btn btn-primary">Editar</a>
            <a href="{{ route('degustacao.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection
