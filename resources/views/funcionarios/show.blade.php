@extends('layouts.funcionario')


@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-white p-4 rounded-4 shadow" style="max-width:500px; width:100%;">
        <h2 class="text-center mb-4" style="font-weight: bold;">Consulta Funcionário</h2>
        <form>
            <div class="row">
                <div class="col-8">
                    <div class="mb-2">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" value="{{ $funcionario->nome }}" readonly>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nome Fantasia</label>
                        <input type="text" class="form-control" value="{{ $funcionario->nome_fantasia ?? '-' }}" readonly>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Cargo</label>
                        <input type="text" class="form-control" value="{{ $funcionario->cargo->nome ?? '-' }}" readonly>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Salário</label>
                        <input type="text" class="form-control" value="{{ number_format($funcionario->salario, 2, ',', '.') }}" readonly>
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
                        <input type="text" class="form-control" value="{{ $funcionario->rg ?? '-' }}" readonly>
                    </div>
                </div>
                <div class="col-4 d-flex flex-column align-items-center justify-content-center">
                    <img src="{{ asset('img/fotos/' . ($funcionario->foto ?? 'default.png')) }}" alt="Foto" class="rounded-circle mb-2" style="width:80px; height:80px; object-fit:cover;">
                    <div>
                        @if(!$funcionario->data_finalizacao)
                            <span class="badge bg-light text-success border border-success px-4 py-2" style="font-size:1.1rem;">ATIVO</span>
                        @else
                            <span class="badge bg-light text-danger border border-danger px-4 py-2" style="font-size:1.1rem;">INATIVO</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary px-5 py-2 fw-bold">VOLTAR</a>
            </div>
        </form>
    </div>
</div>
@endsection