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
                    <td><a href="{{ route('livros.show', $livro->titulo) }}">{{ $livro->titulo }}</a></td>
                    <td>{{ $livro->isbn }}</td>
                    <td>{{ $livro->editor->nome ?? 'Sem editor' }}</td>
                    <td>{{ $livro->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('livros.edit', $livro->titulo) }}" class="btn btn-primary">
                            <i class="fa-solid fa-pencil-alt"></i></a>
                        <a href="{{ route('livros.destroy', $livro->idlivro) }}" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i></a>
                    
                    </td>
                </tr>
                @endforeach
            </tbody>   
           
        </table>
        </div>

