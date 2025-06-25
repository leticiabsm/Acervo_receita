@extends('layouts.livro')
@section('title', 'Visualizar Livro Publicado')

@section('content')
<div class="content-wrapper text-center mb-4">
    <h2 class="text-white">Visualizar Livro Publicado</h2>
</div>

<div class="container bg-light p-4 rounded shadow-lg">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('img/livro_comida_caseira.jpeg') }}" alt="Livro" class="img-fluid mb-3 rounded">
            <div class="mb-3"><strong>Título:</strong> {{ $livroPublicado->titulo }}</div>
            <div class="mb-3"><strong>Editor:</strong> {{ $livroPublicado->editor }}</div>
            <div class="mb-3"><strong>ISBN:</strong> {{ $livroPublicado->isbn }}</div>
            <div class="mb-3"><strong>Cozinheiro:</strong> {{ $livroPublicado->cozinheiro ?? '-' }}</div>
            <div class="mb-3"><strong>Nome Fantasia:</strong> {{ $livroPublicado->nome_fantasia ?? '-' }}</div>
        </div>
        <div class="col-md-8">
            <div class="mb-3">
                <strong>Texto do Livro:</strong>
                <div class="border p-2 bg-white" style="min-height:200px;">{{ $livroPublicado->texto_livro }}</div>
            </div>
            <a href="{{ route('publicacao.pdf', $livroPublicado->id) }}" target="_blank" class="btn btn-success">
                Abrir PDF
            </a>
        </div>
    </div>
</div>
@endsection