<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Medida</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 700px; margin: 30px auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; margin-bottom: 25px; }
        .details-box { border: 1px solid #e0e0e0; padding: 20px; border-radius: 5px; margin-top: 20px; background-color: #f9f9f9; }
        .details-box p { margin-bottom: 10px; line-height: 1.6; }
        .details-box strong { color: #555; }
        .btn-group { display: flex; justify-content: flex-start; gap: 10px; margin-top: 25px; }
        .btn { padding: 10px 15px; border-radius: 5px; text-decoration: none; color: white; font-size: 16px; cursor: pointer; border: none; transition: background-color 0.3s ease; display: inline-block; }
        .btn-warning { background-color: #ffc107; color: #212529; } .btn-warning:hover { background-color: #e0a800; }
        .btn-secondary { background-color: #6c757d; } .btn-secondary:hover { background-color: #5a6268; }
        .btn-danger { background-color: #dc3545; } .btn-danger:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalhes da Medida</h1>

        <div class="details-box">
            <p><strong>Descrição:</strong> {{ $medida->descricao }}</p>
            <p><strong>Criado em:</strong> {{ $medida->created_at->format('d/m/Y H:i:s') }}</p>
            <p><strong>Última Atualização:</strong> {{ $medida->updated_at->format('d/m/Y H:i:s') }}</p>
        </div>

        <div class="btn-group">
            <a href="{{ route('medidas.edit', $medida->idMedida) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('medidas.destroy', $medida->idMedida) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta medida?')">Excluir</button>
            </form>
            <a href="{{ route('medidas.index') }}" class="btn btn-secondary">Voltar para a Lista</a>
        </div>
    </div>
</body>
</html>