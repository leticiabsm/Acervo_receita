@extends('layouts.nota')

@section('title', 'Adicionar Nota')

@section('content')
    @if (session('msg'))
        <div class="alert alert-warning alert-dismissible fade show text-center mx-auto" role="alert" id="flash-message"
            style="max-width: 600px;">
            {{ session('msg') }}
        </div>

        <script>
            setTimeout(function () {
                let alertBox = document.getElementById('flash-message');
                if (alertBox) {
                    alertBox.classList.remove('show');
                    alertBox.classList.add('fade');
                }
            }, 3000);
        </script>
    @endif

    <div class="container my-5">
        <h3 style="color: #ffffff;">Adicionar Nota da Receita</h3>
        <div class="card p-5 shadow rounded-4" style="background-color: #ffffff;">
            <div class="row d-flex align-items-stretch text-start">
                {{-- COLUNA ESQUERDA --}}
                <div class="col-md-4 d-flex flex-column justify-content-center">
                    <h5 class="fw-bold">{{ $receita->nome_rec }}</h5>
                    <p><strong>Ingredientes:</strong> {{ $receita->ingredientes ?? 'macarrão, cenoura' }}</p>
                    <p><strong>Tempo de Preparo:</strong> {{ $receita->tempo_de_preparo }}</p>
                    <p><strong>Porção:</strong> {{ $receita->porcao ?? '1,5 kg por pessoa' }}</p>
                    <p><strong>Nome Cozinheiro:</strong> {{ $receita->FKcozinheiro }}</p>
                    <p><strong>Nome Fantasia (cozinheiro):</strong> {{ $receita->nome_fantasia ?? 'Fogaça' }}</p>
                </div>

                {{-- COLUNA CENTRAL --}}
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <h5 class="fw-bold text-center mb-3">Receita</h5>
                    <div class="border rounded p-1 mb-3" style="border-color: orange;">
                        <img src="{{ asset('images/cook_book.jpg') }}" alt="Imagem Receita" class="img-fluid rounded">
                    </div>
                    <div class="w-100">
                        <label for="descricao" class="form-label fw-bold">Comentário</label>
                        <textarea name="descricao" id="descricao" rows="4" class="form-control rounded"
                            placeholder="Digite seu comentário..."></textarea>
                    </div>
                </div>

                {{-- COLUNA DIREITA --}}
                <div class="col-md-4 d-flex flex-column justify-content-between">
                    {{-- Formulário de Busca (formulário separado para acionar a pesquisa via Enter) --}}
                    <form method="GET" action="{{ route('degustacao.create') }}" class="mb-4 d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Buscar receita para degustar"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </form>

                    {{-- Formulário para enviar a avaliação (todos os campos ficam juntos) --}}
                    <form action="{{ route('degustacao.store') }}" method="POST" class="w-100">
                        @csrf
                        <input type="hidden" name="FKReceita" value="{{ $receita->idReceitas }}">
                        <input type="hidden" name="FKcozinheiro" value="{{ $receita->FKcozinheiro }}">

                        {{-- O campo de comentário foi movido para este formulário --}}
                        <input type="hidden" name="descricao" id="descricao-hidden" value="">
                        
                        <div class="mb-3">
                            <label for="nota_degustacao" class="form-label fw-bold">Avaliar Receita</label>
                            <input type="number" name="nota_degustacao" id="nota_degustacao" class="form-control"
                                min="0" max="10" step="0.5" value="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Atribua uma nota de 0 a 10</label>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-auto">
                            <button type="submit" class="btn btn-success px-4 fw-bold">ADICIONAR</button>
                            <a href="{{ route('degustacao.index') }}" class="btn btn-secondary px-4 fw-bold">VOLTAR</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script para transferir o valor do textarea para o campo hidden antes de submeter --}}
    <script>
        const formAvaliacao = document.querySelector('form[action="{{ route('degustacao.store') }}"]');
        formAvaliacao.addEventListener('submit', function () {
            // Pega o valor do textarea localizado na coluna central
            const descricao = document.getElementById('descricao').value;
            // Define esse valor no campo hidden que está dentro do formulário de avaliação
            document.getElementById('descricao-hidden').value = descricao;
        });
    </script>
@endsection
