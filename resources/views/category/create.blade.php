@extends('layouts.main')
@section('title', 'categorias')
@section('content') 
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-sky-400 to-blue-500">
    <div class="bg-white rounded-2xl shadow-md p-8 w-[320px]">
        <h2 class="text-xl font-semibold text-center text-white mb-6 drop-shadow">Adicionar Categoria</h2>

        <form method="POST" action="/categories">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm text-gray-700 mb-1">Categoria</label>
                <input type="text" id="nome" name="nome" placeholder="Nome da categoria"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400"
                       required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm text-gray-700 mb-1">Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Categoria da Receita"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400"
                          rows="2" required></textarea>
            </div>

            <div class="flex justify-between">
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow font-bold">
                    ADICIONAR
                </button>

                <a href="/categories"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow font-bold">
                    VOLTAR
                </a>
            </div>
        </form>
    </div>
</div>

@endsection