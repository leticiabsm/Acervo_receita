<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index()
    {
        $categorias = Category::all();
        return view('category.categories', ['categorias' => $categorias]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $categoria = new Category();

        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;
        $categoria->data_inicio = now();
        $categoria->data_fim = $request->data_fim;
        $categoria->ind_ativo = $request->ind_ativo ?? true;

        $categoria->save();

        return redirect('/categories')->with('msg', 'ensagem criado com suceso!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'string',
            'ind_ativo' => 'required|boolean'
        ]);

        $category = Category::findOrFail($id);

        $category->nome = $request->input('nome');
        $category->descricao = $request->input('descricao');
        $category->ind_ativo = $request->input('ind_ativo');
        $category->save();

        return redirect()->route('category.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        return view('category.delete', compact('category'));
    }

    public function destroy($id)
    {

    $category = Category::findOrFail($id);
    $category->ind_ativo = 0;
    $category->data_fim = now();
    $category->save();

    return redirect()->route('category.index')->with('success', 'Categoria desativada com sucesso!');
    }
}
