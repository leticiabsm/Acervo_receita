<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minha Aplicacao')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-primary bg-gradient d-flex flex-column justify-content-start  min-vh-100">

    <header class="text-center">
        @yield('before_title') <!-- Novo espaço antes do título -->
        <h1>@yield('title', 'Livro de receitas')</h1>
    </header>

    <main class="content-wrapper">
        @yield('content')
    </main>

</body>
</html>