@extends('layouts.cozinheiro')

@section('content')
@if(Auth::check())
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="dashboard-card w-100" style="max-width: 900px; position: relative;">
        <h2 class="text-center mb-4" style="font-weight: bold;">Painel do Cozinheiro</h2>

        <!-- Resumo -->
        <table class="table table-summary mb-4">
            <tbody>
                <tr>
                    <td>Total de Receitas Criadas</td>
                    <td class="text-end">{{ $totalReceitas ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Receitas Aguardando Degustação</td>
                    <td class="text-end">{{ $totalPedidos ?? 0 }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row align-items-stretch">
            <!-- Funções -->
            <div class="col-md-5 d-flex flex-column">
                <div class="fw-bold mb-2">Funções</div>
                <div class="funcoes-card mb-4 flex-grow-1">
                    <div class="list-group funcoes-list">
                        <a href="{{ route('receitas.index') }}" class="list-group-item">
                            Receitas
                            <i class="bi bi-eye icon-eye"></i>
                        </a>
                        <a href="{{ route('ingredientes.index') }}" class="list-group-item">
                            Ingredientes
                            <i class="bi bi-gear icon-gear"></i>
                        </a>
                        <a href="{{ route('medidas.index') }}" class="list-group-item">
                            Medidas
                            <i class="bi bi-gear icon-gear"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Meta de Receitas no Mês -->
            <div class="col-md-7 d-flex flex-column align-items-center justify-content-between">
                @php
                $meta = 10;
                $criadas = $totalReceitas ?? 0;
                $prazo = '30 de Março';
                $percent = min(100, intval(($criadas / $meta) * 100));
                $faltam = max(0, $meta - $criadas);
                @endphp
                <div class="card mb-3 p-3 w-100" style="max-width: 400px;">
                    <div class="fw-bold mb-2">Meta de Receitas no Mês</div>
                    <div>Meta: {{ $meta }} receitas</div>
                    <div>Criadas até agora: {{ $criadas }}/{{ $meta }}</div>
                    <div>Prazo: {{ $prazo }}</div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <div class="progress my-0" style="height: 22px; width: 70%;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span style="font-weight:bold; color:#198754; min-width: 70px; font-size: 0.85rem;">
                            {{ $percent }}% concluído
                        </span>
                    </div>
                    <div>Status: Faltam {{ $faltam }} receitas para atingir a meta.</div>
                    <a href="{{ route('receitas.create') }}" class="btn btn-success mt-3" style="font-weight:bold;">
                        Nova Receita <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
                <img src="{{ asset('img/icons/user_cog.png') }}" alt="Ícone Cozinheiro" style="opacity:0.15; max-width:120px; max-height:120px;">
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