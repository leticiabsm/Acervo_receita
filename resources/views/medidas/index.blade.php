<<<<<<< HEAD

@extends('layouts.medidas')

@section('content')

 <h2 class="titulo-pagina mb-0">Consulta de Medidas</h2>
<div class="container table-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
       
        <div class="d-flex align-items-center">
            <form action="{{ route('medidas.index') }}" method="GET" class="d-flex align-items-center me-2">
                <input type="text" name="search" class="form-control search-bar" placeholder="Pesquisar" value="{{ request('search') }}">
                <button type="submit" class="btn btn-light ms-2"><span class="bi bi-search"></span>Pesquisar</button>
            </form>
            <a href="{{ route('medidas.create') }}" class="btn btn-success ms-2">Adicionar Medida</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Item</th>
                <th>Descrição</th>
                <th class="text-center">Atividade</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($medidas as $medida)
                <tr>
                    <td>
                        <a href="{{ route('medidas.show', $medida->idMedida) }}" style="color:#ffb300; text-decoration:underline;">
                            {{ $medida->tipo }}
                        </a>
                    </td>
                    <td>{{ $medida->item }}</td>
                    <td>{{ $medida->descricao }}</td>
                    <td class="text-center">
                        <a href="{{ route('medidas.edit', $medida->idMedida) }}" class="btn btn-primary btn-sm me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('medidas.destroy', $medida->idMedida) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta medida?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhuma medida encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
=======
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
>>>>>>> 67dfb4b630a576f1e22302d877c3f24abb08e720
