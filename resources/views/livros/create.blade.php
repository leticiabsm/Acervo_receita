@extends('layouts.livro')

@section('content')
<div class="content-wrapper text-center mb-4">
    <h2 class="text-white">Adicionar Livro</h2>
</div>

<div class="container bg-light p-4 rounded shadow-lg">
    <form action="{{ route('livros.store') }}" method="POST" enctype="multipart/form-data" class="w-100">
        @csrf
        <div class="row">
            {{-- Coluna 1: Dados do Livro --}}
            <div class="col-md-4">
                <img src="{{ asset('img/livro_comida_caseira.jpeg') }}" alt="Livro" class="img-fluid mb-3 rounded">

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="editor" class="form-label">Editor Responsável:</label>
                    <input type="text" name="editor" id="editor" class="form-control" required value="{{ $editor_nome }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN:</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" required pattern="\d{3}-\d-\d{3}-\d{5}-\d">
                </div>
                <div class="mb-3">
                    <label for="cozinheiro" class="form-label">Nome do Cozinheiro:</label>
                    <input type="text" name="cozinheiro" id="cozinheiro" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nome_fantasia" class="form-label">Nome Fantasia (Cozinheiro):</label>
                    <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="capa_livro" class="form-label">Adicionar Capa:</label>
                    <input type="file" name="capa_livro" id="capa_livro" class="form-control">
                </div>
            </div>

            {{-- Coluna 2: Texto do Livro e Imagem --}}
            <div class="col-md-4 border-start border-end">
                <div class="mb-3">
                    <label for="texto_livro" class="form-label">Texto do Livro:</label>
                    <textarea name="texto_livro" id="texto_livro" class="form-control" rows="10" placeholder="Escreva o conteúdo do livro aqui..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="imagem_livro" class="form-label">Imagem Ilustrativa:</label>
                    <input type="file" name="imagem_livro" id="imagem_livro" class="form-control">
                </div>
            </div>

            {{-- Coluna 3: Seleção de Receita --}}
            <div class="col-md-4 ps-4" style="position:relative;">
                <h5>Incluir Receita</h5>
                {{-- Input de pesquisa por nome (lupa) --}}
                <div class="input-group mb-3">
                    <input type="text" id="pesquisa-receita" class="form-control" placeholder="Pesquisar Receita...">
                    <span class="input-group-text">
                        <img src="{{ asset('img/icons/lupa.png') }}" alt="Pesquisar" width="20" height="20">
                    </span>
                </div>
                {{-- Input de filtragem por categoria (filtro) --}}
                <div class="input-group mb-3" style="position:relative;">
                    <input type="text" id="filtragem-receita" class="form-control" placeholder="Filtrar Receita...">
                    <span class="input-group-text" id="dropdownFilter" style="cursor:pointer;">
                        <img src="{{ asset('img/icons/filter.png') }}" alt="Filtrar" width="20" height="20">
                    </span>
                    {{-- Bloco para dropdown e drop lateral --}}
                    <div id="dropdown-bloco" style="position:absolute; left:0; top:100%; z-index:30; display:flex;">
                        {{-- Dropdown de filtro --}}
                        <div id="dropdown-opcoes" class="dropdown-menu" style="display:none; position:relative; min-width:150px;">
                            <a class="dropdown-item" href="#" onclick="mostrarListaLateral('receitas');return false;">Ctg.Receitas</a>
                            <a class="dropdown-item" href="#" onclick="mostrarListaLateral('cozinheiros');return false;">Ctg.Cozinheiros</a>
                        </div>
                        {{-- Drop lateral para listas --}}
                        <div id="drop-lateral" style="display:none; position:relative; min-width:220px; background:#fff; border:1px solid #ccc; z-index:20; box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                            <div id="lista-receitas-lateral" style="display:none;">
                                <h6 class="p-2 border-bottom">Receitas Existentes</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach($receitas as $receita)
                                    <li class="list-group-item receita-item"
                                        data-nome="{{ $receita->nome_rec }}">
                                        {{ $receita->nome_rec }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div id="lista-cozinheiros-lateral" style="display:none;">
                                <h6 class="p-2 border-bottom">Cozinheiros</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach($funcionarios as $funcionario)
                                    <li class="list-group-item cozinheiro-item"
                                        data-nome="{{ $funcionario->nome }}"
                                        data-fantasia="{{ $funcionario->nome_fantasia }}">
                                        {{ $funcionario->nome }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('styles')
<style>
    #dropdown-opcoes .dropdown-item.selected {
        background: #e6f0ff;
        color: #007bff;
        font-weight: bold;
        border-left: 4px solid #007bff;
    }

    #dropdown-opcoes {
        min-width: 150px;
    }

    #drop-lateral {
        min-width: 220px;
    }

    #dropdown-bloco {
        display: flex;
        align-items: flex-start;
    }

    .cozinheiro-item,
    .receita-item {
        cursor: pointer;
        transition: background 0.2s;
    }

    .cozinheiro-item:hover,
    .receita-item:hover {
        background: #f0f8ff;
    }
</style>
@endpush

@push('scripts')
<script>
    // Mostra o dropdown ao clicar no ícone de filtro
    document.getElementById('dropdownFilter').onclick = function(event) {
        event.stopPropagation();
        let dropdown = document.getElementById('dropdown-opcoes');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        document.getElementById('drop-lateral').style.display = 'none';
    };

    // Mostra o drop lateral de acordo com a opção escolhida
    function mostrarListaLateral(tipo) {
        document.querySelectorAll('#dropdown-opcoes .dropdown-item').forEach(function(el) {
            el.classList.remove('selected');
        });
        if (tipo === 'receitas') {
            document.querySelector('#dropdown-opcoes .dropdown-item:nth-child(1)').classList.add('selected');
        } else {
            document.querySelector('#dropdown-opcoes .dropdown-item:nth-child(2)').classList.add('selected');
        }

        let dropLateral = document.getElementById('drop-lateral');
        let listaReceitas = document.getElementById('lista-receitas-lateral');
        let listaCozinheiros = document.getElementById('lista-cozinheiros-lateral');
        dropLateral.style.display = 'block';
        listaReceitas.style.display = (tipo === 'receitas') ? 'block' : 'none';
        listaCozinheiros.style.display = (tipo === 'cozinheiros') ? 'block' : 'none';

        document.getElementById('dropdown-opcoes').style.display = 'block';
        event?.stopPropagation?.();
    }

    // Gera um ISBN aleatório e preenche o campo ao carregar a página
    function gerarISBN() {
        function rand(n) {
            return Math.floor(Math.random() * n);
        }
        let parte1 = 978;
        let parte2 = rand(10);
        let parte3 = String(rand(1000)).padStart(3, '0');
        let parte4 = String(rand(100000)).padStart(5, '0');
        let parte5 = rand(10);
        return `${parte1}-${parte2}-${parte3}-${parte4}-${parte5}`;
    }

    // Preenche os campos ao clicar em um cozinheiro ou receita
    document.addEventListener('DOMContentLoaded', function() {
        // Preenche ISBN automaticamente
        document.getElementById('isbn').value = gerarISBN();

        // Cozinheiro
        document.querySelectorAll('.cozinheiro-item').forEach(function(item) {
            item.addEventListener('click', function() {
                document.getElementById('cozinheiro').value = this.getAttribute('data-nome');
                document.getElementById('nome_fantasia').value = this.getAttribute('data-fantasia');
                document.getElementById('dropdown-opcoes').style.display = 'none';
                document.getElementById('drop-lateral').style.display = 'none';
            });
        });
        // Receita
        document.querySelectorAll('.receita-item').forEach(function(item) {
            item.addEventListener('click', function() {
                let nomeReceita = this.getAttribute('data-nome');
                let textarea = document.getElementById('texto_livro');
                textarea.value = "Receita escolhida: " + nomeReceita + "\n\n" + textarea.value;
                // Aqui você pode adicionar lógica para imagem quando houver
                document.getElementById('dropdown-opcoes').style.display = 'none';
                document.getElementById('drop-lateral').style.display = 'none';
            });
        });
    });

    // Fecha os menus ao clicar fora
    document.addEventListener('click', function(event) {
        document.getElementById('dropdown-opcoes').style.display = 'none';
        document.getElementById('drop-lateral').style.display = 'none';
    });

    // Impede o fechamento ao clicar dentro do drop lateral
    document.getElementById('drop-lateral').onclick = function(event) {
        event.stopPropagation();
    };

    // Impede o fechamento ao clicar dentro do dropdown-opcoes
    document.getElementById('dropdown-opcoes').onclick = function(event) {
        event.stopPropagation();
    };
</script>
@endpush
@endsection