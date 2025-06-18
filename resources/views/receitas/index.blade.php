
@extends('layouts.receita2')


@section('content')
<div class="container mt-5">
    <h2 class="mb-4" style="font-weight: bold; color: #fff;">Lista de Receitas</h2>
        <div class="d-flex mb-3">
            <!--botao de incluir funcionário-->
            <form class="flex-grow-1 me-2 d-flex" method="GET" action="{{ route('funcionarios.index') }}">
                <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar" value="{{ request('pesquisa') }}">
                <button type="submit" class="btn" style="background:transparent; border:none; margin-left:-40px;">
                    <img src="{{ asset('img/icons/lupa.png') }}" alt="Pesquisar" style="width:22px; height:22px;">
                </button>
            </form>
            <a href="{{ route('receitas.create') }}"
                class="btn d-flex align-items-center"
                style="background:#83CD71; border:3px solid #25BB00; color:#fff; font-weight:bold;">
                Incluir Receita
                <img src="{{ asset('img/icons/user_plus_add.png') }}" alt="Incluir Receita" style="width:22px; height:22px;" class="ms-3">
            </a>

            </div>
    <!--
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
-->
            <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nome da Receita</th>
                        <th>ingredientes</th>
                        <th>Cozinheiro Resposalvel</th>
                        <th>Categoria</th>
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
        </div><!--table responsive-->
    </div>
</div>
@endsection