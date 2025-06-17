@extends('layouts.ingrediente')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4" style="font-weight: bold; color: #fff;">Consulta de Ingredientes</h2>
    <div class="d-flex mb-3">
        <form class="flex-grow-1 me-2 d-flex" method="GET" action="{{ route('ingredientes.index') }}">
            <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar" value="{{ request('pesquisa') }}">
            <button type="submit" class="btn" style="background:transparent; border:none; margin-left:-40px;">
                <img src="{{ asset('img/icons/lupa.png') }}" alt="Pesquisar" style="width:22px; height:22px;">
            </button>
        </form>
        <a href="{{ route('ingredientes.create') }}" 
            class="btn d-flex align-items-center"
            style="background:#83CD71; border:3px solid #25BB00; color:#fff; font-weight:bold;">
            Adicionar Ingrediente
            <img src="{{ asset('img/icons/add_ingredient.png') }}" alt="Adicionar Ingrediente" style="width:22px; height:22px;" class="ms-3">
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th class="text-center">Ingrediente</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Atividades</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredientes as $ingrediente)
                <tr class="clickable-row" data-href="{{ route('ingredientes.show', $ingrediente->id) }}" style="cursor:pointer;">
                    <td>{{ $ingrediente->nome }}</td>
                    <td class="text-center">{{ $ingrediente->descricao ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('ingredientes.edit', $ingrediente->id) }}" class="btn btn-sm p-1 me-1"
                            style="background:#67C0FF; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;"
                            onclick="event.stopPropagation()">
                            <img src="{{ asset('img/icons/edit.png') }}" alt="Editar" style="width:18px; height:18px;">
                        </a>
                        <a href="{{ route('ingredientes.delete', $ingrediente->id) }}" 
                            class="btn btn-sm p-1"
                            style="background:#FF7979; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;"
                            onclick="event.stopPropagation()">
                            <img src="{{ asset('img/icons/trash.png') }}" alt="Excluir" style="width:18px; height:18px;">
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.clickable-row').forEach(function(row) {
            row.addEventListener('click', function(e) {
                window.location = this.dataset.href;
            });
        });
    });
</script>
@endsection
