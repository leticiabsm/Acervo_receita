@extends('layouts.categorias')
@section('title', 'Consulta de Categoria')

@section('content')
    <div class="container my-5">
        <div class="text-center mb-4">
            <h2>Consulta Categoria</h2>
        </div>

        <div class="card shadow mx-auto p-4" style="max-width: 500px;">
            <div class="mb-3">
                <label class="form-label fw-bold">Categoria</label>
                <p class="form-control-plaintext">{{ $categoria->nome_cat }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Descrição</label>
                <p class="form-control-plaintext">{{ $categoria->desc }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Data Início</label>
                <p class="form-control-plaintext">
                    {{ $categoria->dt_ini_cat ? \Carbon\Carbon::parse($categoria->dt_ini_cat)->format('d/m/Y') : '-' }}
                </p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Data Fim</label>
                <p class="form-control-plaintext">
                    {{ $categoria->dt_fim_cat ? \Carbon\Carbon::parse($categoria->dt_fim_cat)->format('d/m/Y') : '-' }}
                </p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <p class="form-control-plaintext">
                    {{ $categoria->ativo ? 'ATIVO' : 'INATIVO' }}
                </p>
            </div>

            <div class="text-end">
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection
