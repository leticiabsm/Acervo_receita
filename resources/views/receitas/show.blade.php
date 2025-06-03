@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Detalhes da Receita: {{ $receita->nome_rec }}</h1>
            <a href="{{ route('receitas.index') }}" class="btn btn-secondary mb-3">Voltar</a>
            <a href="{{ route('receitas.edit', $receita->idReceitas) }}" class="btn btn-warning mb-3">Editar Receita</a>

            <div class="card mb-4">
                <div class="card-header">Informações da Receita</div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $receita->idReceitas }}</p>
                    <p><strong>Cozinheiro:</strong> {{ $receita->cozinheiro ? $receita->cozinheiro->nome : 'N/A' }}</p>
                    <p><strong>Categoria:</strong> {{ $receita->categoria ? $receita->categoria->nome_categoria : 'N/A' }}</p>
                    <p><strong>Data de Criação:</strong> {{ \Carbon\Carbon::parse($receita->dt_criacao)->format('d/m/Y') }}</p>
                    <p><strong>Porções:</strong> {{ $receita->quat_porcao }}</p>
                    <p><strong>Receita Inédita:</strong> {{ $receita->ind_rec_inedita == 'S' ? 'Sim' : 'Não' }}</p>
                    <p><strong>Dificuldade:</strong> {{ $receita->dificudade_receitas }}</p>
                    <p><strong>Tempo de Preparo:</strong> {{ $receita->tempo_de_preparo }}</p>
                    <p><strong>Modo de Preparo:</strong></p>
                    <p>{{ $receita->preparo }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Ingredientes</div>
                <div class="card-body">
                    @if ($ingredientesComMedidas->isNotEmpty())
                        <ul class="list-group">
                            @foreach ($ingredientesComMedidas as $item)
                                <li class="list-group-item">
                                    {{ $item->quantidade }}
                                    {{ $item->medida ? $item->medida->item . ' (' . $item->medida->tipo . ')' : 'N/A' }} de
                                    <strong>{{ $item->ingrediente ? $item->ingrediente->nome : 'N/A' }}</strong>
                                    @if ($item->observacao)
                                        <small class="text-muted">({{ $item->observacao }})</small>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Nenhum ingrediente adicionado a esta receita.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection