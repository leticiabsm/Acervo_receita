@extends('layouts.livro')

@section('title', 'Index')

@section('content')
<div class="content-wrapper mb-3">
    <h2>Consulta de Livros</h2>
</div>

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('livros.create') }}" class="btn btn-success" style="font-weight:bold;">
        Incluir Livro
    </a>
</div>
<div class="container bg-white p-4 rounded shadow-lg">
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Título do Livro</th>
                <th>ISBN</th>
                <th>Editor</th>
                <th>Data de Criação</th>
                <th>Atividades</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
            <tr>
                <td>
                    <a href="{{ route('livros.show', $livro->idlivro) }}" style="color: #FFA800; font-weight: 500;">
                        {{ $livro->titulo }}
                    </a>
                </td>
                <td>{{ $livro->isbn }}</td>
                <td>{{ $livro->editor ?? 'Sem editor' }}</td>
                <td>{{ $livro->created_at ? $livro->created_at->format('d/m/Y') : '' }}</td>
                <td>
                    <a href="{{ route('livros.edit', $livro->idlivro) }}" class="btn btn-primary btn-sm" title="Editar">
                        <img src="{{ asset('img/icons/la_pen.png') }}" alt="Editar" style="width:20px; height:20px;">
                    </a>
                    <form action="{{ route('livros.destroy', $livro->idlivro) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                            <img src="{{ asset('img/icons/mynaui_trash.png') }}" alt="Excluir" style="width:20px; height:20px;">
                        </button>
                    </form>
                    <a href="{{ route('livros.download', $livro->idlivro) }}" class="btn btn-success btn-sm" title="Publicar/Download">
                        <img src="{{ asset('img/icons/material_download.png') }}" alt="Download" style="width:20px; height:20px;">
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection