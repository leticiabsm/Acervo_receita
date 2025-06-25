@extends('layouts.nota')

@section('title', 'Degustação')

@section('content')
@if (session('msg'))
@php
// Define o tipo de alerta: success, warning, error ou info (padrão é success)
$alertType = session('alert-type') ?? 'success';

// Mapeia o tipo de alerta para a classe CSS do Bootstrap
switch ($alertType) {
case 'success':
$alertClass = 'alert-success';
break;
case 'warning':
$alertClass = 'alert-warning';
break;
case 'error':
$alertClass = 'alert-danger';
break;
default:
$alertClass = 'alert-info';
break;
}
@endphp

<div id="flash-message" class="alert {{ $alertClass }} alert-dismissible fade show text-center mx-auto" role="alert" style="max-width: 600px;">
    {{ session('msg') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<script>
    setTimeout(function() {
        let alertBox = document.getElementById('flash-message');
        if (alertBox) {
            alertBox.classList.remove('show');
            alertBox.classList.add('fade');
        }
    }, 3000);
</script>
@endif
<div class="container my-5">
    <h2 class="mb-4 text-white">Consulta de Notas</h2>

    <div class="d-flex mb-4" style="gap: 10px;">
        <form action="{{ route('degustacao.index') }}" method="GET" class="flex-grow-1">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar"
                value="{{ request('search') }}">
        </form>
        <a href="{{ route('degustacao.create') }}"
            class="btn btn-success d-flex align-items-center gap-2 shadow rounded px-3 py-2">
            Adicionar Nota
            <i class="fa-regular fa-star"></i>
        </a>
    </div>

    <div class="card shadow rounded-4 p-4">
        <table class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>Nome da receita</th>
                    <th>Data da nota</th>
                    <th>Nota</th>
                    <th>Atividades</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($degustacoes as $degustacao)
                <tr>
                    <td>
                        <a href="{{ route('degustacao.show', $degustacao->idDesgustacao) }}">
                            <span class="categoria-link">{{ $degustacao->receita->nome_rec ?? '-' }}</span>
                        </a>
                    </td>
                    <td>
                        {{ $degustacao->data_degustacao ? date('d/m/Y', strtotime($degustacao->data_degustacao)) : '-' }}
                    </td>
                    <td>{{ $degustacao->nota_degustacao ?? '-' }}</td>
                    <td>
                        <a href="{{ route('degustacao.edit', $degustacao->idDesgustacao) }}" class="btn btn-primary p-1" title="Editar">
                            <img src="{{ asset('img/icons/la_pen.png') }}" alt="Editar" style="width:22px; height:22px;">
                        </a>
                        <form action="{{ route('degustacao.destroy', $degustacao->idDesgustacao) }}" method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Tem certeza que deseja excluir esta degustação?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger p-1" title="Excluir">
                                <img src="{{ asset('img/icons/mynaui_trash.png') }}" alt="Excluir" style="width:22px; height:22px;">
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhuma nota encontrada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection