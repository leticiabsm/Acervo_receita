
@extends('layouts.receita')

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

                {{-- Campos da Receita --}}
                <div class="card mb-4">
                    <div class="card-header">Detalhes da Receita</div>
                    <div class="card-body">
                        <!-- ...seus campos normais aqui... -->
                        <div class="mb-3">
                            <label for="nome_rec" class="form-label">Nome da Receita</label>
                            <input type="text" class="form-control" id="nome_rec" name="nome_rec" value="{{ old('nome_rec', $receita->nome_rec) }}" required>
                        </div>
                        <!-- ...demais campos... -->
                        <div class="mb-3">
                            <label for="tempo_de_preparo" class="form-label">Tempo de Preparo (HH:MM:SS)</label>
                            <input type="time" step="1" class="form-control" id="tempo_de_preparo" name="tempo_de_preparo" value="{{ old('tempo_de_preparo', $receita->tempo_de_preparo) }}" required>
                        </div>
                    </div>
                </div>

                {{-- Seção de Ingredientes --}}
                <div class="card mb-4">
                    <div class="card-header">Ingredientes da Receita</div>
                    <div class="card-body">
                        <div id="ingredientes-container">
                            {{-- Ingredientes existentes --}}
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
                            {{-- Campos antigos em caso de erro de validação --}}
                            @if (old('ingredientes_receita') && !empty(old('ingredientes_receita')))
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

{{-- Template oculto para JS --}}
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
    <script src="{{ mix('js/receitas.js') }}"></script>
@endpush