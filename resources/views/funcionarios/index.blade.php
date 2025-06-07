@extends('layouts.funcionario')


@section('content')
<div class="container mt-5">
    <h2 class="mb-4" style="font-weight: bold; color: #fff;">Consulta de Funcionários</h2>
    <div class="d-flex mb-3">
        <form class="flex-grow-1 me-2 d-flex" method="GET" action="{{ route('funcionarios.lista') }}">
            <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar" value="{{ request('pesquisa') }}">
            <button type="submit" class="btn" style="background:transparent; border:none; margin-left:-40px;">
                <img src="{{ asset('img/icons/lupa.png') }}" alt="Pesquisar" style="width:22px; height:22px;">
            </button>
        </form>
        <a href="{{ route('cadastro.form') }}"
            class="btn d-flex align-items-center"
            style="background:#83CD71; border:3px solid #25BB00; color:#fff; font-weight:bold;">
            Incluir Funcionário
            <img src="{{ asset('img/icons/user_plus_add.png') }}" alt="Incluir Funcionário" style="width:22px; height:22px;" class="ms-3">
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Cargo</th>
                    <th class="text-center">Data de ingresso</th>
                    <th class="text-center">Data fim</th>
                    <th class="text-center">Salário recebido</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Atividades</th>
                </tr>
            </thead>
            <tbody>
                @foreach($funcionarios as $funcionario)
                <tr class="clickable-row" data-href="{{ route('funcionarios.show', $funcionario->id) }}" style="cursor:pointer;">
                    <td>{{ $funcionario->nome }}</td>
                    <td class="text-center">{{ $funcionario->cargo->nome ?? '-' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($funcionario->data_inicio)->format('d/m/Y') }}</td>
                    <td class="text-center">
                        @if($funcionario->data_finalizacao)
                        {{ \Carbon\Carbon::parse($funcionario->data_finalizacao)->format('d/m/Y') }}
                        @else
                        -
                        @endif
                    </td>
                    <td class="text-center">R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</td>
                    <td class="text-center">
                        @if(!$funcionario->data_finalizacao)
                        <span class="text-success fw-bold">ATIVO</span>
                        @else
                        <span style="color:#FF3030; font-weight:bold;">INATIVO</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-sm p-1 me-1"
                            style="background:#67C0FF; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;"
                            onclick="event.stopPropagation()">
                            <img src="{{ asset('img/icons/la_pen.png') }}" alt="Editar" style="width:18px; height:18px;">
                        </a>
                        <a href="{{ route('funcionarios.confirmDelete', $funcionario->id) }}"
                            class="btn btn-sm p-1"
                            style="background:#FF7979; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;">
                            <img src="{{ asset('img/icons/mynaui_trash.png') }}" alt="Excluir" style="width:18px; height:18px;">
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.clickable-row').forEach(function(row) {
            row.addEventListener('click', function(e) {
                window.location = this.dataset.href;
            });
        });
    });


    function confirmarDesativacao(btn) {
        const nome = btn.getAttribute('data-nome');
        if (confirm(`Deseja realmente desativar o funcionário ${nome}?`)) {
            btn.closest('form').submit();
        }
    }
</script>