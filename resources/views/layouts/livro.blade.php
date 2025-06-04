<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Aplicacao</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-primary bg-gradient d-flex flex-column justify-content-start  min-vh-100">

<header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="btn btn-secondary">Painel</a>
                    </li>
                    <li class="nav-item">
                        <h1>Livro de Receitas</h1>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
        @yield('content')

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Receitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Receitas App</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="#" class="btn btn-secondary">Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('receitas.index') }}">Receitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ingredientes.index') }}">Ingredientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('medidas.index') }}">Medidas</a>
                    </li>
                    {{-- Adicione outros links de navegação aqui --}}
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts') {{-- Importante para o JavaScript das views --}}
</body>
</html>