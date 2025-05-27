@extends('layouts.app')
@section('title', 'categorias')
@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Consulta de Categoria</h2>
        <form action="{{ route('category.index') }}" method="GET" class="d-flex" style="gap: 10px;">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar Categorias"
                value="{{ request('search') }}">
            <!--<button type="submit" class="btn btn-primary">Buscar</button>-->
            <a href="{{ route('category.create') }}" class="btn btn-add-categoria">Incluir Categoria
                <i class="fa-solid fa-utensils"></i>
            </a>
        </form>
        <form action="{{ route('category.index') }}" method="GET" class="d-flex mb-4 right" style="gap: 10px;">
        </form>
        <div class="card shadow">
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
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td><a href="{{route('category.show', $categoria->id)}}"><span class="categoria-link">{{ $categoria->nome }}</span></a></td>
                            <td>{{ $categoria->descricao }}</td>
                            <td>
                                {{ $categoria->data_inicio ? date('d/m/Y', strtotime($categoria->data_inicio)) : '-' }}
                            </td>
                            <td>
                                {{ $categoria->data_fim ? date('d/m/Y', strtotime($categoria->data_fim)) : '-' }}
                            </td>

                            <td class="status-active">{{ $categoria->ind_ativo == 1 ? 'ATIVO' : 'INATIVO' }}</td>
                            <td>
                                <a href="{{ route('category.edit', $categoria->id) }}" class="btn btn-sm btn-edit"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('category.delete', $categoria->id) }}" class="btn btn-sm btn-delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
