@extends('layouts.livro')

@section('title', 'Index')

@section('content')
<div class="content-wrapper">
    <h2>Consulta de livros</h2>
</div>

<div>
    <a href="{{ route('livros.create') }}" class="btn btn-success">Incluir livro</a>
</div>
<div class="container bg-white p-4 rounded shadow-lg">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título do livro</th>
                <th>ISBN</th>
                <th>Editor</th>
                <th>Data de Criação</th>
                <th>Atividades</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
            <tr>
                <td><a href="{{ route('livros.show', $livro->idlivro) }}">{{ $livro->titulo }}</a></td>
                <td>{{ $livro->isbn }}</td>
                <td>{{ $livro->editor ?? 'Sem editor' }}</td>
                <td>{{ $livro->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('livros.edit', $livro->idlivro) }}" class="btn btn-primary">
                        <i class="fa-solid fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('livros.destroy', $livro->idlivro) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection