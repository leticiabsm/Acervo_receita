@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Consulta de Restaurantes</h4>
            <a href="{{ route('restaurantes.create') }}" class="btn btn-add">Adicionar Restaurante</a>
        </div>
        <table class="table table-bordered table-hover text-center">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Telefone</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurantes as $restaurante)
                    <tr>
                        <td>{{ $restaurante->nome }}</td>
                        <td>{{ $restaurante->contato }}</td>
                        <td>{{ $restaurante->telefone }}</td>
                        <td>
                            @if ($restaurante->ativo)
                                <span class="badge bg-success">Ativo</span>
                            @else
                                <span class="badge bg-secondary">Inativo</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('restaurantes.edit', $restaurante->id) }}" class="btn btn-sm btn-edit">Editar</a>
                            <form action="{{ route('restaurantes.destroy', $restaurante->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete">Excluir</button>
                            </form>
                            <a href="{{ route('restaurantes.show', $restaurante->id) }}" class="btn btn-sm btn-view">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
