@extends('layouts.funcionario')

@section('content')
@if(session('admin_logged_in'))
<!-- Conteúdo protegido -->


<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="dashboard-card w-100" style="max-width: 700px; position: relative;">
        
        <h2 class="text-center mb-4" style="font-weight: bold;">Painel Principal</h2>

        <!-- Resumo -->
        <table class="table table-summary mb-4">
            <tbody>
                <tr>
                    <td>Total de Funcionários</td>
                    <td class="text-end">{{ $totalFuncionarios }}</td>
                </tr>
                <tr>
                    <td>Total de Cargos</td>
                    <td class="text-end">{{ $totalCargos }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Funções -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="fw-bold mb-2">Funções</div>
                <div class="funcoes-card mb-4">
                    <div class="list-group funcoes-list">
                        <a href="{{ route('funcionarios.index') }}" class="list-group-item">
                            Funcionários
                            <i class="bi bi-gear icon-gear"></i>
                        </a>
                        <a href="{{ route('cargos.index') }}" class="list-group-item">
                            Cargos
                            <i class="bi bi-gear icon-gear"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            Categorias
                            <i class="bi bi-gear icon-gear"></i>
                        </a>
                        <a href="{{ route('receitas.index') }}" class="list-group-item">
                            Receitas
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="#" class="list-group-item">
                            Restaurantes
                            <i class="bi bi-gear icon-gear"></i>
                        </a>
                        <!-- Adicione mais itens conforme necessário -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img src="{{ asset('img/icons/user_cog.png') }}" alt="Usuário ADM" style="opacity:0.15; max-width:160px; max-height:160px;">
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
/*mudei*/

.user-info {
    display: flex;
    justify-content: flex-end; /* Move os ícones para a direita */
    align-items: center;
    padding-right: 2rem; /* Ajusta a posição */
    gap: 0.7rem; /* Espaçamento entre os elementos */
    flex-grow: 1; /* Permite que ocupe o espaço restante */
}
    .navbar-funcionario .btn-back {
        display: none;
    }

    /* Oculta o título "Funcionários" */
    .navbar-funcionario .title {
        display: none;
    }
    /*até aqui*/

    .logout-icon {
        width: 22px;
        height: 22px;
        margin-left: 0.5rem;
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

    .funcoes-list .list-group-item.active {
        background: #e9ecef;
    }

    .icon-gear,
    .icon-eye {
        font-size: 1.2rem;
        color: #888;
    }

    .icon-eye {
        color: #222;
    }

    .icon-user-gear {
        opacity: 0.15;
        font-size: 6rem;
        position: absolute;
        right: 30px;
        bottom: 30px;
    }

    @media (max-width: 991px) {
        .icon-user-gear {
            display: none;
        }
    }
</style>
@endpush