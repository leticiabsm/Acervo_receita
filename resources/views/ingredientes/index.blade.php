<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ingredientes</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 900px; margin: 30px auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; margin-bottom: 25px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px; }
        .top-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 10px 15px; border-radius: 5px; text-decoration: none; color: white; font-size: 16px; cursor: pointer; border: none; transition: background-color 0.3s ease; display: inline-block; }
        .btn-success { background-color: #28a745; } .btn-success:hover { background-color: #218838; }
        .btn-info { background-color: #17a2b8; } .btn-info:hover { background-color: #138496; }
        .btn-warning { background-color:rgb(8, 63, 245); color:rgb(247, 248, 248); } .btn-warning:hover { background-color:rgb(45, 0, 224); }
        .btn-danger { background-color: #dc3545; } .btn-danger:hover { background-color: #c82333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        td:last-child { text-align: center; }
        .actions-cell { white-space: nowrap; }
        .actions-cell form { display: inline-block; margin-left: 5px; }

        /* Estilos da barra de pesquisa */
        .search-form { display: flex; gap: 10px; }
        .search-form input[type="text"] { flex-grow: 1; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; font-size: 16px; }
        .search-form button { padding: 10px 15px; border-radius: 5px; background-color: #007bff; color: white; border: none; cursor: pointer; transition: background-color 0.3s ease; }
        .search-form button:hover { background-color: #0056b3; }

        /* Estilo para o link do Nome (igual ao link-tipo das medidas) */
        .link-nome {
            color:rgb(7, 11, 255); /* Cor amarelo/alaranjado, similar ao btn-warning */
            text-decoration: none; /* Remove sublinhado padrão do link */
            font-weight: bold; /* Deixa o texto em negrito, se desejar */
        }
        .link-nome:hover {
            text-decoration: underline; /* Adiciona sublinhado ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Ingredientes</h1>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="top-section">
            {{-- Formulário de Pesquisa --}}
            <form action="{{ route('ingredientes.index') }}" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Pesquisar ingredientes..." value="{{ request('search') }}">
                <button type="submit">Pesquisar</button>
            </form>

            <a href="{{ route('ingredientes.create') }}" class="btn btn-success">Adicionar Novo Ingrediente</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ingredientes as $ingrediente)
                    <tr>
                        <td><a href="{{ route('ingredientes.show', $ingrediente->idIngrediente) }}" class="link-nome">{{ $ingrediente->nome }}</a></td>
                        <td>{{ $ingrediente->descricao }}</td>
                        <td class="actions-cell">
                            <a href="{{ route('ingredientes.edit', $ingrediente->idIngrediente) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('ingredientes.destroy', $ingrediente->idIngrediente) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este ingrediente?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Nenhum ingrediente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>