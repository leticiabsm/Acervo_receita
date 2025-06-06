<div class="row mb-3 ingrediente-item" data-index="{{ $index }}">
    <div class="col-md-4">
        <label for="ingredientes_receita_{{ $index }}_idIngrediente" class="form-label">Ingrediente</label>
        <select class="form-control" id="ingredientes_receita_{{ $index }}_idIngrediente" name="ingredientes_receita[{{ $index }}][idIngrediente]" required>
            <option value="">Selecione o Ingrediente</option>
            @foreach ($ingredientes as $ingrediente)
                <option value="{{ $ingrediente->idIngrediente }}" {{ (string)$selectedIngrediente == (string)$ingrediente->idIngrediente ? 'selected' : '' }}>
                    {{ $ingrediente->nome }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label for="ingredientes_receita_{{ $index }}_idMedida" class="form-label">Medida</label>
        <select class="form-control" id="ingredientes_receita_{{ $index }}_idMedida" name="ingredientes_receita[{{ $index }}][idMedida]" required>
            <option value="">Selecione a Medida</option>
            @foreach ($medidas as $medida)
                <option value="{{ $medida->idMedida }}" {{ (string)$selectedMedida == (string)$medida->idMedida ? 'selected' : '' }}>
                    {{ $medida->item }} ({{ $medida->tipo }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label for="ingredientes_receita_{{ $index }}_quantidade" class="form-label">Quantidade</label>
        <input type="number" step="0.01" class="form-control" id="ingredientes_receita_{{ $index }}_quantidade" name="ingredientes_receita[{{ $index }}][quantidade]" value="{{ old('ingredientes_receita.' . $index . '.quantidade', $quantidade) }}" required>
    </div>
    <div class="col-md-2">
        <label for="ingredientes_receita_{{ $index }}_observacao" class="form-label">Observação</label>
        <input type="text" class="form-control" id="ingredientes_receita_{{ $index }}_observacao" name="ingredientes_receita[{{ $index }}][observacao]" value="{{ old('ingredientes_receita.' . $index . '.observacao', $observacao) }}">
    </div>
    {{-- Remover o botão 'X' se não houver funcionalidade de remoção via JS --}}
    {{-- <div class="col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger remove-ingrediente">X</button>
    </div> --}}
</div>