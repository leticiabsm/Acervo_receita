@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Medidas</h2>
        <a href="{{ route('measures.create') }}" class="btn btn-primary">Adicionar Medida</a>
    </div>

    @if ($measures->isEmpty())
        <div class="alert alert-info" role="alert">
            Nenhuma medida cadastrada ainda.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Abreviação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($measures as $measure)
                    <tr>
                        <td>{{ $measure->id }}</td>
                        <td>{{ $measure->name }}</td>
                        <td>{{ $measure->abbreviation ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('measures.show', $measure->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('measures.edit', $measure->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('measures.destroy', $measure->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta medida?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $measures->links() }}
    @endif
@endsection