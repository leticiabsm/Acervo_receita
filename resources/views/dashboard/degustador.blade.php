@extends('layouts.degustador')

@section('content')
@if(Auth::check())
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="dashboard-card w-100" style="max-width: 900px; position: relative;">
        <h2 class="text-center mb-4" style="font-weight: bold;">Painel do Degustador</h2>

        <!-- Resumo -->
        <table class="table table-summary mb-4">
            <tbody>
                <tr>
                    <td>Total de Receitas Criadas</td>
                    <td class="text-end">{{ $totalReceitas ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Receitas Aguardando Degustação</td>
                    <td class="text-end">{{ $receitasParaAvaliar ?? 0 }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row align-items-stretch">
            <!-- Funções -->
            <div class="col-md-5 d-flex flex-column">
                <div class="fw-bold mb-2">Funções</div>
                <div class="funcoes-card mb-4 flex-grow-1">
                    <div class="list-group funcoes-list">
                        <a href="{{ route('degustacao.index') }}" class="list-group-item">
                            Notas receitas
                            <i class="bi bi-gear icon-gear"></i>
                        </a>
                        <a href="{{ route('receitas.index') }}" class="list-group-item">
                            Receitas
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    body {
        overflow: hidden;
    }

    .dashboard-card {
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        background: #fff;
        padding: 2.5rem 2rem;
        margin-top: 40px;
    }

    .table-summary {
        border-radius: 8px;
        overflow: hidden;
    }

    .table-summary th,
    .table-summary td {
        background: #f8f9fa;
        border: none;
    }

    .funcoes-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
    }

    .funcoes-list .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: none;
        border-radius: 0;
        background: transparent;
        font-weight: 500;
        font-size: 1.05rem;
    }

    .funcoes-list .list-group-item:hover {
        background: #e0e3e7;
    }

    .icon-gear,
    .icon-eye {
        font-size: 1.2rem;
        color: #888;
    }

    .icon-eye {
        color: #222;
    }

    .progress {
        background: #e9ecef;
        border-radius: 8px;
        overflow: hidden;
    }

    .progress-bar {
        background: #4caf50;
        font-weight: bold;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: width 0.6s ease;
    }

    @media (max-width: 991px) {
        .icon-user-gear {
            display: none;
        }

        .dashboard-card {
            padding: 1.2rem 0.5rem;
        }
    }
</style>
@endpush