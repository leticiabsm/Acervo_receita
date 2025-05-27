@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Consulta de Restaurantes</h2>
    <a href="{{ route('restaurantes.create') }}" class="btn btn-primary">Adicionar Restaurante</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Contato</th>
                <th>Telefone</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($restaurantes as $restaurante)
            <tr>
                <td>{{ $restaurante->nome }}</td>
                <td>{{ $restaurante->contato }}</td>
                <td>{{ $restaurante->telefone }}</td>
                <td>{{ $restaurante->ativo ? 'Ativo' : 'Inativo' }}</td>
                <td>
                    <a href="{{ route('restaurantes.edit', $restaurante->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('restaurantes.destroy', $restaurante->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                    <a href="{{ route('restaurantes.show', $restaurante->id) }}" class="btn btn-sm btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


<!-- resources/views/restaurantes/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Testando View</title>
</head>
<body>
    <h1>View carregada com sucesso!</h1>
</body>
</html>

