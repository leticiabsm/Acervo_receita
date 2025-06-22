@extends('layouts.medidas')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4" style="font-weight: bold; color: #fff;">Consulta de Medidas</h2>
    <div class="d-flex mb-3">
        <form class="flex-grow-1 me-2 d-flex" method="GET" action="{{ route('medidas.index') }}">
            <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar" value="{{ request('pesquisa') }}">
            <button type="submit" class="btn" style="background:transparent; border:none; margin-left:-40px;">
                <img src="{{ asset('img/icons/lupa.png') }}" alt="Pesquisar" style="width:22px; height:22px;">
            </button>
        </form>
        <a href="{{ route('medidas.create') }}" 
            class="btn d-flex align-items-center"
            style="background:#83CD71; border:3px solid #25BB00; color:#fff; font-weight:bold;">
            Adicionar Medida
            <img src="{{ asset('img/icons/add_measure.png') }}" alt="Adicionar Medida" style="width:22px; height:22px;" class="ms-3">
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Item</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Atividades</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medidas as $medida)
                <tr class="clickable-row" data-href="{{ route('medidas.show', $medida->idMedida) }}" style="cursor:pointer;">
                    <td>{{ $medida->tipo }}</td>
                    <td class="text-center">{{ $medida->item }}</td>
                    <td class="text-center">{{ $medida->descricao ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('medidas.edit', $medida->idMedida) }}" class="btn btn-sm p-1 me-1"
                            style="background:#67C0FF; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; border-radius:6px;"
                            onclick="event.stopPropagation()">
                            <img src="{{ asset('img/icons/edit.png') }}" alt="Editar" style="width:18px; height:18px;">
                        </a>
                        <a href="{{ route('medidas.destroy', $medida->idMedida) }}" 
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
