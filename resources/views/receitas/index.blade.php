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
                        <th>Nome da Receita</th>
                        <th>ingredientes</th>
                        <th>Cozinheiro Resposalvel</th>
                        <th>Categoria</th>
                        <th>Data de criação</th>
                        <th>Atividades</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($receitas as $receita)
                        <tr>
                            <td>{{ $receita->nome_rec }}</td>
                            <td>
                                @if ($receita->ingredientes->isNotEmpty())
                                    <ul>
                                        @foreach ($receita->ingredientes as $ingrediente)
                                            <li>{{ $ingrediente->quantidade }} {{ $ingrediente->medida ? $ingrediente->medida->item : '' }} de {{ $ingrediente->nome }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Nenhum ingrediente adicionado.
                                @endif
                            <td>{{ $receita->cozinheiro ? $receita->cozinheiro->nome : 'N/A' }}</td>
                            <td>{{ $receita->categoria ? $receita->categoria->nome_categoria : 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($receita->dt_criacao)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('receitas.show', $receita->nome_rec) }}" class="btn btn-info btn-sm">Ver</a>
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