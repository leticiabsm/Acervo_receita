@extends('layouts.receitas')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Editar Receita: {{ $receita->nome_rec }}</h1>
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

            <form action="{{ route('receitas.update', $receita->idReceitas) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card mb-4">
                    <div class="card-header">Detalhes da Receita</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="nome_rec" class="form-label">Nome da Receita</label>
                            <input type="text" class="form-control" id="nome_rec" name="nome_rec"
                                   value="{{ old('nome_rec', $receita->nome_rec) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tempo_de_preparo" class="form-label">Tempo de Preparo (HH:MM:SS)</label>
                            <input type="time" step="1" class="form-control" id="tempo_de_preparo" name="tempo_de_preparo"
                                   value="{{ old('tempo_de_preparo', $receita->tempo_de_preparo) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="FKcozinheiro" class="form-label">Cozinheiro Responsável</label>
                            <select class="form-control" id="FKcozinheiro" name="FKcozinheiro" required>
                                <option value="">Selecione um Cozinheiro</option>
                                @foreach ($cozinheiros as $cozinheiro)
                                    <option value="{{ $cozinheiro->id }}"
                                        {{ old('FKcozinheiro', $receita->FKcozinheiro) == $cozinheiro->id ? 'selected' : '' }}>
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
                                    <option value="{{ $categoria->id_cat }}"
                                        {{ old('FKCategoria', $receita->FKCategoria) == $categoria->id_cat ? 'selected' : '' }}>
                                        {{ $categoria->nome_categoria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="dt_criacao" class="form-label">Data de Criação</label>
                            <input type="date" class="form-control" id="dt_criacao" name="dt_criacao"
                                   value="{{ old('dt_criacao', \Carbon\Carbon::parse($receita->dt_criacao)->format('Y-m-d')) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="preparo" class="form-label">Modo de Preparo</label>
                            <textarea class="form-control" id="preparo" name="preparo" rows="5" required>{{ old('preparo', $receita->preparo) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="quat_porcao" class="form-label">Quantidade por Porção</label>
                            <input type="number" step="0.1" class="form-control" id="quat_porcao" name="quat_porcao"
                                   value="{{ old('quat_porcao', $receita->quat_porcao) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Receita Inédita?</label>
                            <select class="form-control" name="ind_rec_inedita" required>
                                <option value="S" {{ old('ind_rec_inedita', $receita->ind_rec_inedita) == 'S' ? 'selected' : '' }}>Sim</option>
                                <option value="N" {{ old('ind_rec_inedita', $receita->ind_rec_inedita) == 'N' ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="dificudade_receitas" class="form-label">Dificuldade</label>
                            <input type="text" class="form-control" id="dificudade_receitas" name="dificudade_receitas"
                                   value="{{ old('dificudade_receitas', $receita->dificudade_receitas) }}" required>
                        </div>
                    </div>
                </div>

                {{-- Ingredientes --}}
                <div class="card mb-4">
                    <div class="card-header">Ingredientes da Receita</div>
                    <div class="card-body">
                        <div id="ingredientes-container">
                            @foreach ($ingredientesReceita as $index => $ingredienteData)
                                @include('receitas.partials.ingrediente_form_field', [
                                    'index' => $index,
                                    'ingredientes' => $ingredientes,
                                    'medidas' => $medidas,
                                    'selectedIngrediente' => $ingredienteData['idIngrediente'],
                                    'selectedMedida' => $ingredienteData['idMedida'],
                                    'quantidade' => $ingredienteData['quantidade'],
                                    'observacao' => $ingredienteData['observacao'],
                                ])
                            @endforeach

                            {{-- Campos antigos (validação com erro) --}}
                            @if (old('ingredientes_receita'))
                                @foreach (old('ingredientes_receita') as $index => $ingredienteOld)
                                    @if (!isset($ingredientesReceita[$index]))
                                        @include('receitas.partials.ingrediente_form_field', [
                                            'index' => $index,
                                            'ingredientes' => $ingredientes,
                                            'medidas' => $medidas,
                                            'selectedIngrediente' => $ingredienteOld['idIngrediente'] ?? '',
                                            'selectedMedida' => $ingredienteOld['idMedida'] ?? '',
                                            'quantidade' => $ingredienteOld['quantidade'] ?? '',
                                            'observacao' => $ingredienteOld['observacao'] ?? '',
                                        ])
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        <button type="button" class="btn btn-success mt-3" id="add-ingrediente">Adicionar Ingrediente</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Receita</button>
            </form>
        </div>
    </div>
</div>

{{-- Template para JS --}}
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
@endsection

@push('scripts')
    <script src="{{ asset('js/receitas.js') }}"></script>
@endpush
