@extends('layouts.app')


@section('content')
    
        <h2>Consulta de livros</h2>
    


    <a href="{{ route('livros.create') }}" class="btn btn-success">Incluir livro</a>

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
                <td><a href="{{ route('livros.show', $livro->titulo) }}">{{ $livro->titulo }}</a></td>
                <td>{{ $livro->isbn }}</td>
                <td>{{ $livro->editor->nome ?? 'Sem editor' }}</td>
                <td>{{ $livro->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
            </tr>
        @endforeach
</tbody>
           
        </table>
    </div>
