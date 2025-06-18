<!-- resources/views/cargos/adicionar.blade.php -->
@extends('layouts.cargos')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="form-section">
        <h2 class="text-center mb-4" style="font-weight: bold;">Adicionar Cargo</h2>

        @if(session('success'))
        <div class="alert alert-success text-center" style="font-weight:bold;">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('cargos.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Cargo</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" name="descricao" id="descricao" class="form-control">
            </div>

            <div class="mb-3">
                <label for="data_inicio" class="form-label">Data Início</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control">
            </div>

            <div class="mb-3">
                <label for="ativo" class="form-label">Status</label>
                <select name="ativo" id="ativo" class="form-select">
                    <option value="1" selected>ATIVO</option>
                    <option value="0">INATIVO</option>
                </select>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <button type="submit" class="btn btn-green px-4">ADICIONAR</button>
                <a href="{{ route('cargos.index') }}" class="btn btn-gray px-4">VOLTAR</a>
            </div>
        </form>
    </div>
</div>
@endsection
