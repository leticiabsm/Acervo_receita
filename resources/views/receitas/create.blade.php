<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Nova Receita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionais, se necessário */
        .ingrediente-item {
            border: 1px solid #e0e0e0;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
@extends('layouts.receita')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Adicionar Nova Receita</h1>
            <a href="{{ route('receitas.index') }}" class="btn btn-secondary mb-3">Voltar</a>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('receitas.store') }}" method="POST">
                @csrf

                {{-- Campos da Receita --}}
                <div class="card mb-4">
                    <div class="card-header">Detalhes da Receita</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nome_rec" class="form-label">Nome da Receita</label>
                            <input type="text" class="form-control" id="nome_rec" name="nome_rec" value="{{ old('nome_rec') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="FKcozinheiro" class="form-label">Cozinheiro</label>
                            <select class="form-control" id="FKcozinheiro" name="FKcozinheiro" required>
                                <option value="">Selecione um Cozinheiro</option>
                                @foreach ($cozinheiros as $cozinheiro)
                                    <option value="{{ $cozinheiro->FK_idFuncionario }}" {{ old('FKcozinheiro') == $cozinheiro->FK_idFuncionario ? 'selected' : '' }}>
                                        {{ $cozinheiro->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="FKCategoria" class="form-label">Categoria</label>
                            <select class="form-control" id="FKCategoria" name="FKCategoria" required>
                                <option value="">Selecione uma Categoria</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->idCategoria }}" {{ old('FKCategoria') == $categoria->idCategoria ? 'selected' : '' }}>
                                        {{ $categoria->nome_categoria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dt_criacao" class="form-label">Data de Criação</label>
                            <input type="date" class="form-control" id="dt_criacao" name="dt_criacao" value="{{ old('dt_criacao', date('Y-m-d')) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="preparo" class="form-label">Modo de Preparo</label>
                            <textarea class="form-control" id="preparo" name="preparo" rows="5" required>{{ old('preparo') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="quat_porcao" class="form-label">Quantidade de Porções</label>
                            <input type="number" step="0.1" class="form-control" id="quat_porcao" name="quat_porcao" value="{{ old('quat_porcao') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ind_rec_inedita" class="form-label">Receita Inédita?</label>
                            <select class="form-control" id="ind_rec_inedita" name="ind_rec_inedita" required>
                                <option value="S" {{ old('ind_rec_inedita') == 'S' ? 'selected' : '' }}>Sim</option>
                                <option value="N" {{ old('ind_rec_inedita') == 'N' ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dificudade_receitas" class="form-label">Dificuldade</label>
                            <select class="form-control" id="dificudade_receitas" name="dificudade_receitas" required>
                                <option value="">Selecione a Dificuldade</option>
                                <option value="Fácil" {{ old('dificudade_receitas') == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                                <option value="Médio" {{ old('dificudade_receitas') == 'Médio' ? 'selected' : '' }}>Médio</option>
                                <option value="Difícil" {{ old('dificudade_receitas') == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tempo_de_preparo" class="form-label">Tempo de Preparo (HH:MM:SS)</label>
                            <input type="time" step="1" class="form-control" id="tempo_de_preparo" name="tempo_de_preparo" value="{{ old('tempo_de_preparo') }}" required>
                        </div>
                    </div>
                </div>

                {{-- Seção de Ingredientes --}}
                <div class="card mb-4">
                    <div class="card-header">Ingredientes da Receita</div>
                    <div class="card-body">
                        <div id="ingredientes-container">
                            {{-- Se houver dados antigos, renderize-os --}}
                            @if (old('ingredientes_receita'))
                                @foreach (old('ingredientes_receita') as $index => $ingredienteOld)
                                    @include('receitas.partials.ingrediente_form_field', [
                                        'index' => $index,
                                        'ingredientes' => $ingredientes,
                                        'medidas' => $medidas,
                                        'selectedIngrediente' => $ingredienteOld['idIngrediente'] ?? '',
                                        'selectedMedida' => $ingredienteOld['idMedida'] ?? '',
                                        'quantidade' => $ingredienteOld['quantidade'] ?? '',
                                        'observacao' => $ingredienteOld['observacao'] ?? '',
                                    ])
                                @endforeach
                            @else
                                {{-- Renderize alguns campos de ingrediente padrão se não houver old input --}}
                                @for ($i = 0; $i < 3; $i++) {{-- Por exemplo, 3 campos padrão --}}
                                    @include('receitas.partials.ingrediente_form_field', [
                                        'index' => $i,
                                        'ingredientes' => $ingredientes,
                                        'medidas' => $medidas,
                                        'selectedIngrediente' => '',
                                        'selectedMedida' => '',
                                        'quantidade' => '',
                                        'observacao' => '',
                                    ])
                                @endfor
                            @endif
                        </div>
                        {{-- Não há botão de "Adicionar Ingrediente" pois não usaremos JS para isso --}}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Receita</button>
            </form>
        </div>
    </div>
</div>

@endsection

{{-- Removemos o @push('scripts') completamente --}}
</body>
</html>