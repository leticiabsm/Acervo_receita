@extends('layouts.receitas')

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
        @php
        $cargo = strtolower(auth()->user()->cargo->nome ?? '');
        @endphp

        @if($cargo === 'cozinheiro')
        <a href="{{ route('receitas.create') }}"
            class="btn d-flex align-items-center"
            style="background:#83CD71; border:3px solid #25BB00; color:#fff; font-weight:bold;">
            Incluir Receita
            <img src="{{ asset('img/icons/user_plus_add.png') }}" alt="Incluir Funcionário" style="width:22px; height:22px;" class="ms-3">
        </a>
        @endif

    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Nome da Receita</th>
                    <th>Cozinheiro Responsável</th>
                    <th>Categoria</th>
                    <th>Data Criação</th>
                    <th>Dificuldade</th>
                    <th>Atividades</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($receitas as $receita)
                <tr>
                    <td>{{ $receita->nome_rec }}</td> {{-- Nome da Receita --}}
                    <td>{{ $receita->cozinheiro ? $receita->cozinheiro->nome : 'N/A' }}</td>
                    <td>{{ $receita->categoria ? $receita->categoria->nome_cat : 'N/A' }}</td>
                    <td>{{ $receita->dt_criacao->format('d/m/Y') }}</td>
                    <td>{{ $receita->dificudade_receitas }}</td>

                    <td class="d-flex gap-2"> {{-- Atividades --}}
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
    </div><!--table responsive-->
</div>
</div>
@endsection