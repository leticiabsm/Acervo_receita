@extends('layouts.receitas') {{-- Assumindo que você tem um layout principal --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-primary mb-3">Consulta de Receitas</h1>

            <div class="d-flex justify-content-between mb-3">
                <form action="{{ route('receitas.index') }}" method="GET" class="d-flex w-50">
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar receitas..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                </form>
                <a href="{{ route('receitas.create') }}" class="btn btn-success">Adicionar Receita</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nome da Receita</th>
                        <th>Ingredientes</th>
                        <th>Cozinheiro Responsável</th>
                        <th>Categoria</th>
                        <th>Data Criação</th>
                        <th>Atividades</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($receitas as $receita)
                        <tr>
                            <td>{{ $receita->nome_rec }}</td>
                            <td>{{ $receita->ingredientes }}</td>
                            <td>{{ $receita->cozinheiro ? $receita->cozinheiro->nome : 'N/A' }}</td>
                            <td>{{ $receita->categoria ? $receita->categoria->nome_categoria : 'N/A' }}</td>
                            <td>{{ $receita->data_criacao }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('receitas.show', $receita->idReceitas) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('receitas.edit', $receita->idReceitas) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('receitas.destroy', $receita->idReceitas) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta receita?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Nenhuma receita encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
