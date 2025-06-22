@extends('layouts.categorias')
@section('title', 'Categorias')
@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-white">Consulta de Categorias</h2>

        <form action="{{ route('categorias.index') }}" method="GET" class="d-flex mb-3" style="gap: 10px;">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar categorias"
                value="{{ request('search') }}">
            <a href="{{ route('categorias.create') }}"
                class="btn btn-success d-flex align-items-center gap-2 shadow rounded px-3 py-2">
                Incluir Categoria
                <i class="fa-solid fa-utensils"></i>
            </a>
        </form>

        <div class="card shadow rounded-4 p-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data Início</th>
                        <th>Data Fim</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $categoria)
                        <tr>
                            <td>
                                <a href="{{ route('categorias.show', $categoria->id_cat) }}">
                                    <span class="categorias-link">{{ $categoria->nome_cat }}</span>
                                </a>
                            </td>
                            <td>{{ $categoria->desc }}</td>
                            <td>
                                {{ $categoria->dt_ini_cat ? date('d/m/Y', strtotime($categoria->dt_ini_cat)) : '-' }}
                            </td>
                            <td>
                                {{ $categoria->dt_fim_cat ? date('d/m/Y', strtotime($categoria->dt_fim_cat)) : '-' }}
                            </td>
                            <td class="{{ $categoria->ind_ativo ? 'status-active' : 'status-inactive' }}">
                                {{ $categoria->ind_ativo ? 'ATIVO' : 'INATIVO' }}
                            </td>
                            <td>
                                <a href="{{ route('categorias.edit', $categoria->id_cat) }}" class="btn btn-primary">
                                    <img src="{{ asset('img/icons/la_pen.png') }}" alt="Editar" style="width:18px; height:18px;">
                                </a>
                                <a href="{{ route('categorias.destroy', $categoria->id_cat) }}" class="btn btn-danger">
                                    <img src="{{ asset('img/icons/mynaui_trash.png') }}" alt="Excluir" style="width:18px; height:18px;">
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
