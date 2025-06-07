@extends('layouts.funcionario')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="dashboard-card w-100" style="max-width: 700px; position: relative;">
        <h2 class="text-center mb-4" style="font-weight: bold;">Gerenciar Funcionário</h2>

        <div class="row">
            <div class="col-md-8">
                <div class="mb-2">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" value="{{ $funcionario->nome }}" readonly>
                </div>
                <div class="mb-2">
                    <label class="form-label">Nome Fantasia</label>
                    <input type="text" class="form-control" value="{{ $funcionario->nome_fantasia }}" readonly>
                </div>
                <div class="mb-2">
                    <label class="form-label">Cargo</label>
                    <input type="text" class="form-control" value="{{ $funcionario->cargo->nome }}" readonly>
                </div>
                <div class="mb-2">
                    <label class="form-label">Salário</label>
                    <input type="text" class="form-control" value="R$ {{ number_format($funcionario->salario, 2, ',', '.') }}" readonly>
                </div>
                <div class="mb-2">
                    <label class="form-label">Data Admissão</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($funcionario->data_inicio)->format('d/m/Y') }}" readonly>
                </div>
                <div class="mb-2">
                    <label class="form-label">Data Finalização</label>
                    <input type="text" class="form-control" value="{{ $funcionario->data_finalizacao ? \Carbon\Carbon::parse($funcionario->data_finalizacao)->format('d/m/Y') : '-' }}" readonly>
                </div>
                <div class="mb-2">
                    <label class="form-label">RG</label>
                    <input type="text" class="form-control" value="{{ $funcionario->rg }}" readonly>
                </div>
            </div>
            <div class="col-md-4 d-flex flex-column align-items-center justify-content-start">
                <div style="border: 3px solid orange; border-radius: 50%; width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                    <img src="{{ asset('img/icons/user_default.png') }}" alt="Foto" style="width: 48px; height: 48px;">
                </div>
                @php
                $classeCorStatus = !$funcionario->data_finalizacao ? 'text-success' : 'text-danger';
                $textoStatus = !$funcionario->data_finalizacao ? 'ATIVO' : 'INATIVO';
                @endphp

                <div class="mb-2">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle fw-bold {{ $classeCorStatus }}" type="button" id="dropdownStatus" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $textoStatus }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownStatus">
                            <li>
                                <button class="dropdown-item text-success" data-url="{{ route('funcionarios.reativar', $funcionario->id)}}" onclick="alterarStatus(this, 'ATIVO', 'text-success')">
                                    ATIVO
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item text-danger" data-url="{{ route('funcionarios.destroy', $funcionario->id) }}" onclick="alterarStatus(this, 'INATIVO', 'text-danger')">
                                    INATIVO
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('funcionarios.lista') }}" class="btn" style="background:#BDBDBD; color:#fff; font-weight:bold; min-width:120px;">VOLTAR</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dashboard-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 2.5rem 2rem;
        max-width: 700px;
    }
</style>
@endpush

@push('scripts')
<script>
    function alterarStatus(element, novoStatus, novaClasse) {
        const dropdownButton = document.getElementById("dropdownStatus");
        const url = element.getAttribute("data-url");

        fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    dropdownButton.innerText = novoStatus;
                    dropdownButton.classList.remove('text-success', 'text-danger');
                    dropdownButton.classList.add(novaClasse);

                    alert(`Status alterado para ${novoStatus} com sucesso!`);
                } else {
                    return response.json().then(data => {
                        console.error(data);
                        alert("Erro ao atualizar status.");
                    });
                }
            })
            .catch(error => console.error("Erro na requisição:", error));
    }
</script>
@endpush