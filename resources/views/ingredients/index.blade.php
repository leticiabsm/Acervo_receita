@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Ingredientes</h2>
        <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Adicionar Ingrediente</a>
    </div>

    @if ($ingredients->isEmpty())
        <div class="alert alert-info" role="alert">
            Nenhum ingrediente cadastrado ainda.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient->id }}</td>
                        <td>{{ $ingredient->name }}</td>
                        <td>
                            <a href="{{ route('ingredients.show', $ingredient->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este ingrediente?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $ingredients->links() }} {{-- Links de paginação --}}
    @endif
@endsection