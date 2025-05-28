<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Medidas</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 900px; margin: 30px auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; margin-bottom: 25px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px; }
        .btn-group-top { margin-bottom: 20px; text-align: right; }
        .btn { padding: 10px 15px; border-radius: 5px; text-decoration: none; color: white; font-size: 16px; cursor: pointer; border: none; transition: background-color 0.3s ease; display: inline-block; }
        .btn-success { background-color: #28a745; } .btn-success:hover { background-color: #218838; }
        /* Removido o estilo do btn-info, se não for mais usado como botão */
        .btn-warning { background-color: #ffc107; color: #212529; } .btn-warning:hover { background-color: #e0a800; }
        .btn-danger { background-color: #dc3545; } .btn-danger:hover { background-color: #c82333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        td:last-child { text-align: center; }
        .actions-cell { white-space: nowrap; }
        .actions-cell form { display: inline-block; margin-left: 5px; }

        /* Novo estilo para o link do Tipo */
        .link-tipo {
            color: #ffc107; /* Cor amarelo/alaranjado, similar ao btn-warning */
            text-decoration: none; /* Remove sublinhado padrão do link */
            font-weight: bold; /* Deixa o texto em negrito, se desejar */
        }
        .link-tipo:hover {
            text-decoration: underline; /* Adiciona sublinhado ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Medidas</h1>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="btn-group-top">
            <a href="{{ route('medidas.create') }}" class="btn btn-success">Adicionar Nova Medida</a>
        </div>

        <table>
            <thead>
                <tr>
                    {{-- Removida a coluna ID --}}
                    <th>Tipo</th>
                    <th>Item</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medidas as $medida)
                    <tr>
                        {{-- Removida a célula ID --}}
                        <td><a href="{{ route('medidas.show', $medida->idMedida) }}" class="link-tipo">{{ $medida->tipo }}</a></td>
                        <td>{{ $medida->item }}</td>
                        <td>{{ $medida->descricao }}</td>
                        <td class="actions-cell">
                            <a href="{{ route('medidas.edit', $medida->idMedida) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('medidas.destroy', $medida->idMedida) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta medida?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Nenhuma medida encontrada.</td> {{-- Ajustado o colspan --}}
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>