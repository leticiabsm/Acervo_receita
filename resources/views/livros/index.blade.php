@extends('layouts.app')

@section('title','Consulta de livros')

@section('content')
    <h1>Consulta de livros</h1>
    <ul>
        @foreach($livros as $livro)
            <li>
                <a href="{{ route('livros.show', $livro->titulo) }}">
                    {{ $livro->titulo }}
                </a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('livros.create') }}" class="btn btn-primary">Incluir livro</a>
    @endsection