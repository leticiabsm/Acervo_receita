<!-- filepath: resources/views/auth/cadastro.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário</title>
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
            max-width: 600px;
            margin: 40px auto;
        }

        .form-control {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
            font-size: 1.05rem;
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

        .avatar-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            gap: 0.5rem;
        }

        .avatar-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid orange;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            background: #f5f5f5;
        }

        .status-ativo {
            color: #4CAF50;
            font-weight: bold;
        }

        .add-photo-btn {
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.3rem 1rem;
            font-size: 1rem;
            font-weight: bold;
        }

        .add-photo-btn:hover {
            background: #388e3c;
        }

        @media (max-width: 768px) {
            .form-section {
                padding: 1rem 0.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-section" style="max-width: 700px;">
            <form method="POST" action="{{ route('cadastro.salvar') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="row g-2">
                            <div class="col-md-6 mb-2">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="cargo_id" class="form-label">Cargo</label>
                                <select name="cargo_id" id="cargo_id" class="form-select" required>
                                    <option value="" disabled selected>Selecione o cargo</option>
                                    @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="salario" class="form-label">Salário</label>
                                <input type="number" step="0.01" name="salario" id="salario" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="data_inicio" class="form-label">Data Admissão</label>
                                <input type="date" name="data_inicio" id="data_inicio" class="form-control" required value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="data_finalizacao" class="form-label">Data Finalização</label>
                                <input type="date" name="data_finalizacao" id="data_finalizacao" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2" id="nomeFantasiaDiv" style="display: none;">
                                <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                                <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="rg" class="form-label">RG</label>
                                <input type="text" name="rg" id="rg" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 avatar-box d-flex flex-column align-items-center justify-content-start">
                        <div class="avatar-img" style="width:60px;height:60px;font-size:2rem;">
                            <span>🙂</span>
                        </div>
                        <span class="status-ativo mt-2">ATIVO</span>
                        <button type="button" class="add-photo-btn mt-2">Adicionar foto</button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6 d-grid">
                        <button type="submit" class="btn btn-green">ADICIONAR</button>
                    </div>
                    <div class="col-6 d-grid">
                        <a href="{{ url()->previous() }}" class="btn btn-gray">VOLTAR</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cargoSelect = document.getElementById('cargo_id');
            const nomeFantasiaDiv = document.getElementById('nomeFantasiaDiv');
            const nomeFantasiaInput = document.getElementById('nome_fantasia');

            function toggleNomeFantasia() {
                const selectedOption = cargoSelect.options[cargoSelect.selectedIndex];
                const nomeCargo = selectedOption ? selectedOption.text.toLowerCase() : '';
                if (nomeCargo === 'cozinheiro') {
                    nomeFantasiaDiv.style.display = 'block';
                } else {
                    nomeFantasiaDiv.style.display = 'none';
                    nomeFantasiaInput.value = '';
                }
            }
            cargoSelect.addEventListener('change', toggleNomeFantasia);
            toggleNomeFantasia();
        });
    </script>
</body>

</html>