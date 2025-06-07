<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #26BFFF 0%, #0070C0 100%);
            min-height: 100vh;
        }

        .login-card {
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            height: 3em;
            border-radius: 10px;
            box-shadow: 1px 3px 4px rgba(0, 0, 0, 0.10);
        }

        .btn-login {
            border: 3px solid #25BB00 !important;
            background-color: #83CD71 !important;
            color: #ffffff;
            font-weight: bold;
        }

        .btn-login:hover {
            border: 3px solid #83CD71 !important;
            background-color: #25BB00 !important;
            color: #ffffff;
        }

        .btn-cancel {
            border: 3px solid #FF3030 !important;
            background-color: #F1735C;
            color: #ffffff;
            font-weight: bold;
        }

        .btn-cancel:hover {
            border: 3px solid #F1735C !important;
            background-color: #FF3030 !important;
            color: #ffffff;
        }

        .link-recuperar {
            color: #1cb5e0;
            text-decoration: none;
            font-size: 0.98rem;
        }

        .link-recuperar:hover {
            text-decoration: underline;
        }

        .login-title {
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100">
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
                <!-- Imagem ilustrativa -->
                <img src="{{ asset('img/undraws/undraw_cooking_and_look.png') }}" alt="Cozinha" class="img-fluid" style="max-height: 450px;">
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="card login-card p-4 w-100" style="max-width: 400px;">
                    <h2 class="text-center mb-4 login-title">LOGIN</h2>

                    {{-- Erros --}}
                    @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha:</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua senha" required>
                        </div>

                        <div class="mb-3 text-center">
                            <a href="{{ route('cadastro.form') }}" class="link-recuperar mx-4">Cadastrar?</a>
                            <a href="#" class="link-recuperar mx-4">Recuperar Senha?</a>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-login flex-fill border border-success">LOGIN</button>
                            <a href="{{ url('/') }}" class="btn btn-cancel flex-fill">CANCELAR</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>