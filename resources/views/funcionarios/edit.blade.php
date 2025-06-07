@php
$corStatus = !$funcionario->data_finalizacao ? '#6DD16F' : '#FF3030';
@endphp

@push('styles')
<style>
    body {
        overflow: hidden;
    }
</style>
@endpush

@extends('layouts.funcionario')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="dashboard-card w-100" style="max-width: 700px; position: relative;">
        <h2 class="text-center mb-4" style="font-weight: bold;">Editar Funcionário</h2>
        <form method="POST" action="{{ route('funcionarios.update', $funcionario->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-2">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" value="{{ old('nome', $funcionario->nome) }}" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" class="form-control" value="{{ old('nome_fantasia', $funcionario->nome_fantasia) }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Cargo</label>
                        <select name="cargo_id" class="form-control" required>
                            @foreach($cargos as $cargo)
                            <option value="{{ $cargo->id }}" {{ $funcionario->cargo_id == $cargo->id ? 'selected' : '' }}>
                                {{ $cargo->nome }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Salário</label>
                        <input type="text" name="salario" class="form-control" value="{{ old('salario', $funcionario->salario) }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Data Admissão</label>
                        <input type="date" name="data_inicio" class="form-control" value="{{ old('data_inicio', $funcionario->data_inicio ? \Carbon\Carbon::parse($funcionario->data_inicio)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">RG</label>
                        <input type="text" name="rg" class="form-control" value="{{ old('rg', $funcionario->rg) }}">
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-start">
                    <div style="border: 3px solid orange; border-radius: 50%; width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                        <img src="{{ asset('img/icons/user_default.png') }}" alt="Foto" style="width: 48px; height: 48px;">
                        <!-- Troque pelo caminho real da foto se houver -->
                    </div>
                    <div class="mb-2">
                        @if(!$funcionario->data_finalizacao)
                        <span class="btn btn-outline-success" style="cursor:default;">ATIVO</span>
                        @else
                        <span class="btn btn-outline-danger" style="cursor:default;">INATIVO</span>
                        @endif
                    </div>
                    <button type="button" class="btn btn-success mb-2" disabled>Editar foto</button>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn" style="background:#6DD16F; color:#fff; font-weight:bold; min-width:120px;">EDITAR</button>
                <a href="{{ route('funcionarios.lista') }}" class="btn" style="background:#BDBDBD; color:#fff; font-weight:bold; min-width:120px;">VOLTAR</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dashboard-card {
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        background: #fff;
        padding: 2.5rem 2rem;
        margin-top: 40px;
    }
</style>
@endpush

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectStatus = document.getElementById("status");

        function updateColor() {
            var selectedOption = selectStatus.options[selectStatus.selectedIndex];
            selectStatus.style.color = selectedOption.style.color; // Aplicando a cor do option
        }

        selectStatus.addEventListener("change", updateColor);
        updateColor(); // Atualizar no carregamento da página
    });
</script>