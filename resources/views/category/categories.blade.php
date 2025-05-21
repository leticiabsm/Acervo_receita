@extends('layouts.main')
@section('title', 'categorias')
@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <h2 class="mb-4">Consulta de Categoria</h2>
            <div class="d-flex justify-content-between mb-4">
                <input type="text" placeholder="Pesquisar Categorias" class="search-bar">
                <a href="{{ route('category.create') }}" class="btn btn-add-categoria">Incluir Categoria <i
                        class="fa-solid fa-utensils"></i></a>
            </div>
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
                            <td><span class="categoria-link">{{ $categoria->nome }}</span></td>
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
