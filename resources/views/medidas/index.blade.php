
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