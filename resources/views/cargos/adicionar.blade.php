<!-- filepath: resources/views/cargos/adicionar.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Cargos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #26BFFF 0%, #0070C0 100%);
            min-height: 100vh;
        }

        .form-section {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 2.5rem 2rem;
            max-width: 400px;
            margin: 40px auto;
        }

        .btn-green {
            background: #4CAF50;
            color: #fff;
            font-weight: bold;
            border: none;
        }

        .btn-green:hover {
            background: #388e3c;
            color: #fff;
        }

        .btn-gray {
            background: #bdbdbd;
            color: #fff;
            font-weight: bold;
            border: none;
        }

        .btn-gray:hover {
            background: #757575;
            color: #fff;
        }

        .form-control[readonly] {
            background: #f5fff5;
            color: #4CAF50;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-section">
            <h2 class="text-center mb-4" style="font-weight: bold;">Adicionar Cargos</h2>
            @if(session('success'))
            <div class="alert alert-success text-center" style="font-weight:bold;">
                {{ session('success') }}
            </div>
            @endif
            <form method="POST" action="{{ route('cargos.salvar') }}">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Cargo</label>
                    <input type="text" name="nome" id="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="data_inicio" class="form-label">Data Início</label>
                    <input type="date" name="data_inicio" id="data_inicio" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" value="ATIVO" readonly>
                    <input type="hidden" name="ativo" value="1">
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-green px-4">ADICIONAR</button>
                    <a href="{{ route('cargos.lista') }}" class="btn btn-gray px-4">VOLTAR</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>