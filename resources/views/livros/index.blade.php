<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
</body>
</html>

@extends('layouts.app')


@section('content')
    <h2>Consulta de livros</h2>

    
    <table border="1" cellpadding="5" cellspacing="2">
<tr>
        <th>Título</th>
        <th>ISBN</th>
    </tr>
    <tr>
        <td>Livro 1</td>
        <td>1234567890123</td>
    </tr>
</table>
    <ul>
        @foreach($livros as $livro)
            <li>
                <a href="{{ route('livros.show', $livro->titulo) }}">
                    {{ $livro->titulo }}
                </a>
            </li>
            <li>
                <p>ISBN: {{ $livro->isbn }}</p>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('livros.create') }}" class="btn btn-success">Incluir livro</a>
@endsection