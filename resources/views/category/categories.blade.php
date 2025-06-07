@extends('layouts.app')
@section('title', 'categorias')
@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Consulta de Categoria</h2>
        <form action="{{ route('category.index') }}" method="GET" class="d-flex" style="gap: 10px;">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar Categorias"
                value="{{ request('search') }}">
            <a href="{{ route('category.create') }}"
                class="btn btn-success d-flex align-items-center gap-2 shadow rounded px-3 py-2">Incluir Categoria
                <i class="fa-solid fa-utensils"></i>
            </a>
        </form>
        <form action="{{ route('category.index') }}" method="GET" class="d-flex mb-4 right" style="gap: 10px;">
        </form>
        <div class="card shadow rounded-4 p-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Data Início</th>
                        <th>Data Fim</th>
                        <th>Status</th>
                        <th>Atividades</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $categoria)
                        <tr>
                            <td><a href="{{ route('category.show', $categoria->idCategoria) }}"><span
                                        class="categoria-link">{{ $categoria->nome_categoria }}</span></a></td>
                            <td>{{ $categoria->descricao }}</td>
                            <td>
                                {{ $categoria->data_inicio_categoria ? date('d/m/Y', strtotime($categoria->data_inicio_categoria)) : '-' }}
                            </td>
                            <td>
                                {{ $categoria->data_fim_categoria ? date('d/m/Y', strtotime($categoria->data_fim_categoria)) : '-' }}
                            </td>

                            <td class="status-active">{{ $categoria->ind_ativo == 1 ? 'ATIVO' : 'INATIVO' }}</td>
                            <td>
                                <a href="{{ route('category.edit', $categoria->idCategoria) }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('category.delete', $categoria->idCategoria) }}" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
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
@endsection
