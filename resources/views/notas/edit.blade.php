@extends('layouts.nota')

@section('title', 'Adicionar Nota')

@section('content')
    <div class="container my-5">
        <h3 style="color: #ffffff;">Adicionar Nota da Receita</h3>
        <div class="card p-5 shadow rounded-4" style="background-color: #ffffff;">
            <div class="row d-flex align-items-stretch text-start">

                {{-- COLUNA ESQUERDA --}}
                <div class="col-md-4 d-flex flex-column justify-content-center">
                    <h5 class="fw-bold">Yakisoba</h5>
                    <p><strong>Ingredientes:</strong> macarrão, cenoura</p>
                    <p><strong>Tempo de Preparo:</strong> 120m</p>
                    <p><strong>Porção:</strong> 1,5 kg por pessoa</p>
                    <p><strong>Nome Cozinheiro:</strong> Joao Pacheco</p>
                    <p><strong>Nome Fantasia (cozinheiro):</strong> Fogaça</p>
                    <p><strong>Degustada por:</strong> <span class="text-secondary text-decoration-underline">Guilherme
                            Abrandes</span></p>
                </div>

                {{-- COLUNA CENTRAL --}}
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <h5 class="fw-bold text-center mb-3">Receita</h5>
                    <div class="border rounded p-1 mb-3" style="border-color: orange;">
                        <img src="{{ asset('images/yakisoba.png') }}" alt="Imagem Yakisoba" class="img-fluid rounded">
                    </div>

                    <div class="w-100">
                        <label for="comentario" class="form-label fw-bold">Comentário</label>
                        <textarea name="comentario" id="comentario" rows="4" class="form-control rounded"
                            placeholder="Digite seu comentário..."></textarea>
                    </div>
                </div>

                {{-- COLUNA DIREITA --}}
                <div class="col-md-4 d-flex flex-column justify-content-between">
                    <form action="{{ route('degustacao.store') }}" method="POST" class="d-flex flex-column h-100">
                        @csrf

                        <div>
                            <div class="mb-3">
                                <label for="nota" class="form-label fw-bold">Avaliar Receita</label>
                                <input type="number" name="nota" id="nota" class="form-control" min="0"
                                    max="10" step="0.5" value="0" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Atribua uma nota de 1 a 10</label>
                            </div>

                            <div class="mb-4">
                                <label for="data_nota" class="form-label fw-bold">Data Criação</label>
                                <input type="date" name="data_nota" id="data_nota" class="form-control"
                                    value="{{ date('Y-m-d') }}" readonly>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-auto">
                            <button type="submit" class="btn btn-success px-4 fw-bold">EDITAR</button>
                            <a href="{{ route('degustacao.index') }}" class="btn btn-secondary px-4 fw-bold">VOLTAR</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection