@extends('layouts.main')
@section('title', 'categorias')
@section('content')
    <h1>Consulta de categorias</h1>
    <div id="search-container" class="col-md-12">
        <a href="/category/create">Incluir categoria</a>
        <form action="">
            <input type="text" id="search" name="search" class="form-control" placeholder="Pesquisar...">
        </form>
    </div>
@endsection