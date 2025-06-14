@extends('layouts.cargos')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold text-white">Editar Cargos</h2>

    <form action="{{ route('cargos.update', $cargo->id) }}" method="POST" class="bg-white p-4 rounded text-dark">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $cargo->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao', $cargo->descricao) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="data_inicio" class="form-label">Data de Início</label>
            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', $cargo->data_inicio) }}">
        </div>

        <div class="mb-3">
            <label for="data_finalizacao" class="form-label">Data de Fim</label>
            <input type="date" class="form-control" id="data_finalizacao" name="data_finalizacao" value="{{ old('data_finalizacao', $cargo->data_finalizacao) }}">
        </div>

        <div class="mb-4">
            <label for="ativo" class="form-label">Status do Cargo</label>
            <select class="form-select" id="ativo" name="ativo">
                <option value="1" {{ $cargo->ativo ? 'selected' : '' }}>ATIVO</option>
                <option value="0" {{ !$cargo->ativo ? 'selected' : '' }}>INATIVO</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">EDITAR</button>
            <a href="{{ route('cargos.index') }}" class="btn btn-secondary">VOLTAR</a>
        </div>
    </form>
</div>
@endsection