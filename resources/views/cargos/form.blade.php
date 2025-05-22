<div class="mb-3">
    <label for="nome_cargo" class="form-label">Nome do Cargo</label>
    <input type="text" name="nome_cargo" class="form-control" value="{{ old('nome_cargo', $cargo->nome_cargo ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="descricao" class="form-label">Descrição</label>
    <textarea name="descricao" class="form-control" rows="3" required>{{ old('descricao', $cargo->descricao ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="data_inicio" class="form-label">Data de Início</label>
    <input type="date" name="data_inicio" class="form-control" value="{{ old('data_inicio', $cargo->data_inicio ?? '') }}">
</div>

<div class="mb-3">
    <label for="data_fim" class="form-label">Data de Fim</label>
    <input type="date" name="data_fim" class="form-control" value="{{ old('data_fim', $cargo->data_fim ?? '') }}">
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="ind_ativo" class="form-check-input" value="1" {{ old('ind_ativo', $cargo->ind_ativo ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="ind_ativo">Ativo</label>
</div>
