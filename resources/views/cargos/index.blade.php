@extends('layouts.app')

@section('content')
<style>
    body,
    html {
        height: 100%;
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 900px; width: 100%;">
        <div class="text-center mb-4">
            <h2>Lista de Cargos</h2>
            <a href="{{ route('cargos.create') }}" class="btn btn-success mt-2">➕ Adicionar Cargo</a>
        </div>

        @if (session('success'))
        <div
            class="alert alert-{{ session('alert_type', 'success') }} text-center user-select-none position-fixed top-0 start-50 translate-middle-x mt-3 shadow"
            id="successAlert"
            style="z-index: 1050; min-width: 300px;"
            role="alert">
            {{ session('success') }}
        </div>
        @endif

        @push('scripts')
        <script>
            setTimeout(function() {
                var alert = document.getElementById('successAlert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);
        </script>
        @endpush

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Ativo?</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cargos as $cargo)
                    <tr class="{{ $cargo->ind_ativo ? '' : 'table-secondary' }}">
                        <td>{{ $cargo->nome_cargo }}</td>
                        <td>{{ $cargo->descricao }}</td>
                        <td>{{ \Carbon\Carbon::parse($cargo->data_inicio)->format('d/m/Y') }}</td>
                        <td>
                            {{ $cargo->data_fim ? \Carbon\Carbon::parse($cargo->data_fim)->format('d/m/Y') : '-' }}
                        </td>
                        <td>
                            <span class="badge {{ $cargo->ind_ativo ? 'bg-success' : 'bg-danger' }}">
                                {{ $cargo->ind_ativo ? 'Sim' : 'Não' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('cargos.edit', $cargo->idCargo) }}" class="btn btn-warning btn-sm me-1">
                                ✏️ Editar
                            </a>
                            <form action="{{ route('cargos.destroy', $cargo->idCargo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza que deseja desativar este cargo?')">
                                    ❌ Desativar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection