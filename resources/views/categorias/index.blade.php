@extends('layouts.categorias')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4" style="font-weight: bold; color: #fff;">Consulta de Categorias</h2>

    <div class="d-flex mb-3">
        <form class="flex-grow-1 me-2 d-flex" method="GET" action="{{ route('categorias.index') }}">
            <input type="text" name="searchInput" class="form-control" placeholder="Pesquisar" value="{{ request('searchInput') }}">
            <button type="submit" class="btn" style="background:transparent; border:none; margin-left:-40px;">
                <img src="{{ asset('img/icons/lupa.png') }}" alt="Pesquisar" style="width:22px; height:22px;">
            </button>
        </form>

        <a href="{{ route('categorias.create') }}"
            class="btn d-flex align-items-center"
            style="background:#83CD71; border:3px solid #25BB00; color:#fff; font-weight:bold;">
            Incluir Categoria
            <img src="{{ asset('img/icons/categoria.png') }}" alt="Incluir Categoria" style="width:22px; height:22px;" class="ms-3">
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Data Início</th>
                    <th class="text-center">Data Fim</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Atividades</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                    <tr class="clickable-row" data-href="{{ route('categorias.show', $categoria->id_cat) }}" style="cursor:pointer;">
                        <td class="text-center">{{ $categoria->nome_cat }}</td>
                        <td class="text-center">{{ $categoria->descricao_cat }}</td>
                        <td class="text-center">{{ $categoria->dt_ini_cat ? date('d/m/Y', strtotime($categoria->dt_ini_cat)) : '-' }}</td>
                        <td class="text-center">{{ $categoria->dt_fim_cat ? date('d/m/Y', strtotime($categoria->dt_fim_cat)) : '-' }}</td>
                        <td class="text-center">
                            @if($categoria->ind_ativo)
                                <span class="text-success fw-bold">ATIVO</span>
                            @else
                                <span style="color:#FF3030; font-weight:bold;">INATIVO</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('categorias.edit', $categoria->id_cat) }}" class="btn btn-sm p-1 me-1"
                                style="background:#67C0FF; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;"
                                onclick="event.stopPropagation()">
                                <img src="{{ asset('img/icons/la_pen.png') }}" alt="Editar" style="width:18px; height:18px;">
                            </a>
                            <a href="{{ route('categorias.destroy', $categoria->id_cat) }}" class="btn btn-sm p-1"
                                style="background:#FF7979; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;"
                                onclick="event.stopPropagation()">
                                <img src="{{ asset('img/icons/mynaui_trash.png') }}" alt="Excluir" style="width:18px; height:18px;">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhuma categoria encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.clickable-row').forEach(function(row) {
            row.addEventListener('click', function() {
                window.location = this.dataset.href;
            });
        });
    });
</script>
@endsection
