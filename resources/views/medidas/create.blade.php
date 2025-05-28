<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Medida</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 600px; margin: 30px auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; margin-bottom: 25px; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="text"], textarea { width: calc(100% - 16px); padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; font-size: 16px; }
        .btn-group { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
        .btn { padding: 10px 20px; border-radius: 5px; text-decoration: none; color: white; font-size: 16px; cursor: pointer; border: none; transition: background-color 0.3s ease; }
        .btn-primary { background-color: #007bff; } .btn-primary:hover { background-color: #0056b3; }
        .btn-secondary { background-color: #6c757d; } .btn-secondary:hover { background-color: #5a6268; }
        .error-message { color: #dc3545; font-size: 0.85em; margin-top: 5px; display: block; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Adicionar Nova Medida</h1>

        <form action="{{ route('medidas.store') }}" method="POST">
            @csrf

            <div>
                <label for="tipo">Tipo (ml, kg, xícara, etc.):</label>
                <input type="text" id="tipo" name="tipo" value="{{ old('tipo') }}" required>
                @error('tipo')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="item">Item (grande, médio, pequeno, etc.):</label>
                <input type="text" id="item" name="item" value="{{ old('item') }}" required>
                @error('item')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="descricao">Quantidade/Descrição:</label>
                <input type="text" id="descricao" name="descricao" value="{{ old('descricao') }}" required>
                @error('descricao')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Adicionar Medida</button>
                <a href="{{ route('medidas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>