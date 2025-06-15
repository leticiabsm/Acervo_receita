@extends('layouts.cozinheiro')

@section('content')
@if(Auth::check())
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="dashboard-card w-100" style="max-width: 700px; position: relative;">
        <h2 class="text-center mb-4" style="font-weight: bold;">Painel do Cozinheiro</h2>

        <!-- Resumo -->
        <table class="table table-summary mb-4">
            <tbody>
                <tr>
                    <td>Receitas Ativas</td>
                    <td class="text-end">{{ $totalReceitas ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Pedidos Pendentes</td>
                    <td class="text-end">{{ $totalPedidos ?? 0 }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Ações -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="fw-bold mb-2">Funções</div>
                <div class="funcoes-card mb-4">
                    <div class="list-group funcoes-list">
                        <a href="#" class="list-group-item">
                            Visualizar Receitas
                            <i class="bi bi-eye icon-eye"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            Pedidos em Andamento
                            <i class="bi bi-gear icon-gear"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            Estoque de Ingredientes
                            <i class="bi bi-archive icon-gear"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img src="{{ asset('img/icons/chef_hat.png') }}" alt="Ícone Cozinheiro" style="opacity:0.15; max-width:160px; max-height:160px;">
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
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

    @media (max-width: 991px) {
        .icon-user-gear {
            display: none;
        }
    }
</style>
@endpush
