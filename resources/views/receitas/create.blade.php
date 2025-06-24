@extends('layouts.receitas')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4" style="font-weight: bold; color: #fff;">Adicionar Nova Receita</h2>

    <a href="{{ route('receitas.index') }}" class="btn btn-secondary mb-3">Voltar</a>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('receitas.store') }}" method="POST">
        @csrf

        {{-- Detalhes da Receita --}}
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
                        <option value="{{ $cozinheiro->id }}" {{ old('FKcozinheiro') == $cozinheiro->id ? 'selected' : '' }}>
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
                        <option value="{{ $categoria->id_cat }}" {{ old('FKCategoria') == $categoria->id_cat ? 'selected' : '' }}>
                            {{ $categoria->nome_cat }}
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
                    <input
                        type="text"
                        pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$"
                        class="form-control"
                        id="tempo_de_preparo"
                        name="tempo_de_preparo"
                        value="{{ old('tempo_de_preparo') }}"
                        placeholder="HH:MM ou HH:MM:SS"
                        required>
                </div>
            </div>
        </div>

        {{-- Ingredientes da Receita --}}
        <div class="card mb-4">
            <div class="card-header">Ingredientes da Receita</div>
            <div class="card-body" id="ingredientes-container">
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
                @include('receitas.partials.ingrediente_form_field', [
                'index'=> 0,
                'ingredientes' => $ingredientes,
                'medidas' => $medidas,
                'selectedIngrediente' => '',
                'selectedMedida' => '',
                'quantidade' => '',
                'observacao' => '',
                ])
                @endif

            </div>
            <button type="button" class="btn btn-success mt-3" id="add-ingrediente">Adicionar Ingrediente</button>

        </div>

        <button type="submit" class="btn btn-success">Salvar Receita</button>
    </form>
</div>

{{-- Template oculto para novos ingredientes via JS --}}
<div id="ingrediente-template" class="d-none">
    <div class="row mb-3 ingrediente-item" data-index="__INDEX__">
        <div class="col-md-4">
            <label class="form-label">Ingrediente</label>
            <select class="form-control" name="ingredientes_receita[__INDEX__][idIngrediente]" required>
                <option value="">Selecione o Ingrediente</option>
                @foreach ($ingredientes as $ingrediente)
                <option value="{{ $ingrediente->idIngrediente }}">{{ $ingrediente->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Medida</label>
            <select class="form-control" name="ingredientes_receita[__INDEX__][idMedida]" required>
                <option value="">Selecione a Medida</option>
                @foreach ($medidas as $medida)
                <option value="{{ $medida->idMedida }}">{{ $medida->item }} ({{ $medida->tipo }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Quantidade</label>
            <input type="number" step="0.01" class="form-control" name="ingredientes_receita[__INDEX__][quantidade]" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Observação</label>
            <input type="text" class="form-control" name="ingredientes_receita[__INDEX__][observacao]">
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger remove-ingrediente">X</button>
        </div>
    </div>
</div>


@php
$ingredienteCount = old('ingredientes_receita') ? count(old('ingredientes_receita')) : 1;
@endphp

<script>
    window.ingredienteCount = @json($ingredienteCount);
</script>
<script src="{{ asset('js/ingredientes.js') }}"></script>


@endsection