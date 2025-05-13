@extends('layouts.main')
@section('title', 'categorias')
@section('content')
    <div>
        <h2>Adicionar categorias</h2>
        <form>
            <div id="create-container" class="mb-4">
                <label for="name">Categoria</label>
                <input type="text" id="name" placeholder="Inserir nome da categoria">
            </div>
            <div class="mb-4">
                <label for="description">Descrição</label>
                <textarea id="description" placeholder="Inserir descrição da categoria"></textarea>
            </div>
            <button type="button" class="w-full bg-gray-300 text-gray-600 font-semibold py-2 rounded-xl">VOLTAR</button>
            <button type="button" class="w-full bg-gray-300 text-green-600 font-semibold py-2 rounded-xl">SALVAR</button>
        </form>
    </div>
@endsection