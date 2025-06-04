@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <h2>Adicionar Livro</h2>
    </div>   
    
    <div class="container bg-white p-4 rounded shadow-lg">
            <div class="row">
                <div class="col-md-4 d-flex flex-column align-items-center border-right border-gray">
            <img src="{{ asset('img/livro_comida_caseira.jpeg') }}" alt="Livro" class="img-resized">

            <form action="{{ route('livros.store') }}" method="POST">
                @csrf
                    <div class="mb-3">
                        <label class="text-sm" for="titulo">Título:</label>
                        <input type="text" name="titulo" required>
                    </div>

                    <div class="mb-3">
                        <label class="text-sm" for="editor">Editor Responsável:</label>
                        <input type="text" id="editor" name="editor">
                    </div>

                    <div class="mb-3">
                        <label class="text-sm" for="isbn">ISBN:</label>
                        <input type="number" id="isbn" name="isbn" required>
                    </div>

                    <div class="mb-3">
                        <label class="text-sm" for="cozinheiro">Nome do cozinheiro:</label>
                        <input type="text" id="cozinheiro" name="cozinheiro">
                    </div>

                    <div class="mb-3">
                        <label class="text-sm" for="nome_fantasia">Nome Fantasia(cozinheiro):</label>
                        <input type="text" id="nome_fantasia" name="nome_fantasia">
                    </div> 
                <button type="submit" class="btn btn-success">Adicionar foto</button>
            </form>
    </div>
            <div class="col-md-4 d-flex flex-column align-items-center border-right border-gray">
                <img src="{{ asset('img/img_comida_caseira.jpeg') }}" alt="imagem comida caseira" class="img-fluid mb-3">
                    
                <button type="submit" class="btn btn-success">Adicionar imagem</button>

                <label class="text" for="comentario">Adicione um comentario</label>
                    <input type="text"id="comentario" id="comentario" name="comentario" placeholder="Escreva um comentário sobre o livro">
                            
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center">
                    
                <button type="submit" class="btn btn-success">Adicionar Receita</button>

                <label class="text" for="comentario">Adicione um comentario</label>
                    <input type="text"id="comentario" id="comentario" name="comentario" placeholder="Escreva um comentário sobre o livro">
                
                <button type="submit" class="btn btn-success">ADICIONAR</button>
                
                <button type="submit" class="btn btn-secondary">VOLTAR</button>


            </div>
    </div>
</div>
@endsection
       