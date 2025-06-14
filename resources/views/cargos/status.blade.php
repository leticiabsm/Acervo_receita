@extends('layouts.cargos')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold text-white">Desativar Cargo</h2>

    <form action="{{ route('cargos.atualizarStatus', $cargo->id) }}" method="POST" class="bg-white p-4 rounded text-dark">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="nome" value="{{ $cargo->nome }}" readonly>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" rows="3" readonly>{{ $cargo->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label for="data_inicio" class="form-label">Data de Início</label>
            <input type="date" class="form-control" id="data_inicio" value="{{ $cargo->data_inicio }}" readonly>
        </div>

        <div class="mb-3">
            <label for="data_finalizacao" class="form-label">Data de Fim</label>
            <input type="date" class="form-control" id="data_finalizacao" value="{{ $cargo->data_finalizacao }}" readonly>
        </div>

        <div class="mb-4">
            <label for="ativo" class="form-label">Status</label>
            <select class="form-select" id="ativo" name="ativo">
                <option value="1" {{ $cargo->ativo ? 'selected' : '' }}>ATIVO</option>
                <option value="0" {{ !$cargo->ativo ? 'selected' : '' }}>INATIVO</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Tem certeza que deseja atualizar o status deste cargo?');">
                DESATIVAR
            </button>
            <a href="{{ route('cargos.index') }}" class="btn btn-secondary">VOLTAR</a>
        </div>
    </form>
</div>
@endsection
