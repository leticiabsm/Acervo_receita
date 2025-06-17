@extends('layouts.receitas') {{-- Assumindo que você tem um layout principal --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Lista de Receitas</h1>
            <a href="{{ route('receitas.create') }}" class="btn btn-primary mb-3">Adicionar Nova Receita</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('receitas.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar receitas..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Receita</th>
                        <th>Cozinheiro</th>
                        <th>Categoria</th>
                        <th>Porções</th>
                        <th>Dificuldade</th>
                        <th>Tempo de Preparo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($receitas as $receita)
                        <tr>
                            <td>{{ $receita->idReceitas }}</td>
                            <td>{{ $receita->nome_rec }}</td>
                            <td>{{ $receita->cozinheiro ? $receita->cozinheiro->nome : 'N/A' }}</td>
                            <td>{{ $receita->categoria ? $receita->categoria->nome_categoria : 'N/A' }}</td>
                            <td>{{ $receita->quat_porcao }}</td>
                            <td>{{ $receita->dificudade_receitas }}</td>
                            <td>{{ $receita->tempo_de_preparo }}</td>
                            <td>
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
                            <td colspan="8">Nenhuma receita encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection