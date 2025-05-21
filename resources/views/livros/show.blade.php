@extends('layouts.app')

@section(çontent')
    <h1>{{ $livro->titulo }}</h1>
    <p>ISBN: {{ $livro->isbn }}</p>
    <a href="{{ route('livros.edit', $livro->titulo) }}">Adicionar</a>
    <form action="{{ route('livros.destroy', $livro->titulo) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
@endsection