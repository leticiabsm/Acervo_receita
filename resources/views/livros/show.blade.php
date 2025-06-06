@extends('layouts.livro')

@section('title', 'Show')

@section('content')
    <div class="content-wrapper">
        <h2>Consulta de Livro</h2>
    </div>   
    
        <div class="container bg-white p-4 rounded shadow-lg">
            <div class="row">
                <div class="col-md-4 d-flex flex-column align-items-center border-right border-gray">
                    <img src="{{ asset('img/livro_comida_caseira.jpeg') }}" alt="Livro" class="img-resized">
            
                    <form action="{{ route('livros.show', $livro->titulo) }}" method="GET">
                        @csrf
                            <div class="mb-3">
                                <p>{{ $livro->titulo }}</p>
                            </div>

                            <div class="mb-3">
                                <p><span>Editor Responsável: </span>{{ $livro->editor }}</p>
                                
                            </div>

                            <div class="mb-3">
                                <p><span>ISBN: </span>{{ $livro->isbn }}</p>

                            </div>

                            <div class="mb-3">
                                <p><span>Nome Cozinheiro: </span>{{ $livro->cozinheiro }}</p>

                            </div>

                            <div class="mb-3">
                                <p><span>Nome Fantasia: </span>{{ $livro->nome_fantasia }}</p>

                            </div>

                    </form>
    
                </div><!--fecha col-md-4 d-flex flex-column align-items-center border-right border-gray"-->

                    <!-- Segunda coluna -->
                        <div class="col-md-4 d-flex flex-column align-items-center border-right border-gray">
                            
                        <p>Prévia</p>

                        <img src="{{ asset('img/img_comida_caseira.jpeg') }}" alt="imagem comida caseira" class="img-fluid mb-3">
                                

                            <label class="text" for="comentario">Adicione um comentario</label>
                                <input type="text"id="comentario" id="comentario" name="comentario" placeholder="Escreva um comentário sobre o livro">
                                        
                        </div>

                    <!-- Terceira coluna -->
                        <div class="col-md-4 d-flex flex-column align-items-center">
                                
                                <p>Receitas incluídas</p>
                
                                <ul>
                                    <li><span>Receita 1<span></li>
                                    <li>Receita 2</li>
                                    <li>Receita 3</li>

                                </ul>


                                <a href="{{ route('livros.index') }}" class="btn btn-secondary">VOLTAR</a>
                        </div>

            </div><!-- fecha row -->
        </div><!-- fecha container bg-white p-4 rounded shadow-lg -->
@endsection