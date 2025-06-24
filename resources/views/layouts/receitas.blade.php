<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title', 'Funcionários')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #26BFFF 0%, #0070C0 100%);
            min-height: 100vh;
        }

        .navbar-funcionario {
            background: #fff;
            border-bottom: 2px solid #e5e5e5;
            padding: 0.7rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-funcionario .left {
            display: flex;
            align-items: center;
        }

        .navbar-funcionario .title {
            font-size: 1.7rem;
            font-weight: bold;
            margin: 0;
        }


        .navbar-funcionario .btn-back {
            background: #EDEAEA;
            border-radius: 20px;
            border: none;
            font-weight: bold;
            padding: 0.3rem 1.2rem 0.3rem 0.7rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.15);
            /* drop shadow */
        }

        .navbar-funcionario .title {
            font-size: 1.7rem;
            font-weight: bold;
            margin: 0;
        }

        .navbar-funcionario .user-info {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .navbar-funcionario .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 3px solid #ff9800;
            object-fit: cover;
            background: #fff;
        }

        .navbar-funcionario .logout-icon {
            width: 22px;
            height: 22px;
            margin-left: 0.5rem;
        }
    </style>
    @stack('styles')
    @vite(['resources/css/login.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar-funcionario">
        <div class="left d-flex align-items-center">
            @php
            $cargo = strtolower(auth()->user()->cargo->nome ?? '');
            @endphp

            <a href="{{ 
                $cargo === 'adm' ? route('dashboard.admin') : 
                ($cargo === 'cozinheiro' ? route('dashboard.cozinheiro') : route('dashboard.editor')) 
                }}" class="btn-back">
                <img src="{{ asset('img/icons/voltar.png') }}" alt="Voltar" style="width:22px; height:22px; margin-right:6px;">
                Painel
            </a>

            <h1 class="title ms-3 mb-0">Receitas</h1>
        </div>
        <div class="user-info">
            <img src="{{ asset('img/icons/user_avatar.png') }}" alt="Avatar" class="user-avatar">
            @php
            $funcionario = \App\Models\Funcionario::find(session('funcionario_id'));
            @endphp
            <span>{{ auth()->user()->nome ?? 'Funcionário' }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:transparent; border:none; padding:0; margin-left:8px;">
                    <img src="{{ asset('img/icons/exit_door.png') }}" alt="Sair" class="logout-icon">
                </button>
            </form>
        </div>
    </nav>

    <div class="container-fluid p-0">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>