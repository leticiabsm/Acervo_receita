<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
</body>
</html>

@extends('layouts.livro')

@section('content')
    <h3>{{ $livro->titulo }}</h3>
    <p>ISBN: {{ $livro->isbn }}</p>
    <a href="{{ route('livros.edit', $livro->titulo) }}" class="btn btn-success">Adicionar</a>
    <form action="{{ route('livros.destroy', $livro->titulo) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
@endsection