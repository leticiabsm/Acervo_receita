
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Restaurantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #007bff, #00bfff);
            font-family: Arial, sans-serif;
            color: #333;
            padding-top: 40px;
        }
        .card {
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 12px;
        }
        .btn-add {
            background-color: #28a745;
            color: white;
        }
        .btn-edit {
            background-color: #007bff;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-view {
            background-color: #6c757d;
            color: white;
        }
        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .header-bar h2 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <div class="header-bar">
                <h2>Restaurantes</h2>
                <a href="{{ url()->previous() }}" class="btn btn-light">Voltar</a>
            </div>
            @yield('content')
        </div>
    </div>
</body>
</html>
