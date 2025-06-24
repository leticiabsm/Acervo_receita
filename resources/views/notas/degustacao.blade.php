@extends('layouts.nota')

@section('title', 'Degustação')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Consulta de Notas</h2>

        <div class="d-flex mb-4" style="gap: 10px;">
            <form action="{{ route('degustacao.index') }}" method="GET" class="flex-grow-1">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar"
                    value="{{ request('search') }}">
            </form>
            <a href="{{ route('degustacao.create') }}"
                class="btn btn-success d-flex align-items-center gap-2 shadow rounded px-3 py-2">
                Adicionar Nota
                <i class="fa-regular fa-star"></i>
            </a>
        </div>

        <div class="card shadow rounded-4 p-4">
            <table class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>Nome da receita</th>
                        <th>Data da nota</th>
                        <th>Nota</th>
                        <th>Atividades</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($degustacoes as $degustacao)
                        <tr>
                            <td>
                                <a href="{{ route('degustacao.show', $degustacao->idDesgustacao) }}">
                                    <span class="categoria-link">{{ $degustacao->receita->nome_rec ?? '-' }}</span>
                                </a>
                            </td>
                            <td>
                                {{ $degustacao->data_degustacao ? date('d/m/Y', strtotime($degustacao->data_degustacao)) : '-' }}
                            </td>
                            <td>{{ $degustacao->nota_degustacao ?? '-' }}</td>
                            <td>
                                <a href="{{ route('degustacao.edit', $degustacao->idDesgustacao) }}"
                                    class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('degustacao.destroy', $degustacao->idDesgustacao) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Tem certeza que deseja excluir esta degustação?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Nenhuma nota encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
