<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $categorias = Category::query()
            ->when($search, function ($query, $search) {
                $query->where('nome_categoria', 'like', '%' . $search . '%')
                    ->orWhere('descricao', 'like', '%' . $search . '%')
                    ->orWhere('data_inicio_categoria', 'like', '%' . $search . '%')
                    ->orWhere('data_fim_categoria', 'like', '%' . $search . '%')
                    ->orWhere('ind_ativo', 'like', '%' . $search . '%');
            })
            ->orderBy('nome_categoria', 'asc')
            ->get();

        return view('category.index', compact('categorias'));
    }


    /*public function index()
    {
        $categorias = Category::all();
        return view('category.categories', ['categorias' => $categorias]);
    }*/

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $categoria = new Category();

        $categoria->nome_categoria = $request->nome_categoria;
        $categoria->descricao = $request->descricao;
        $categoria->data_inicio_categoria = now();
        $categoria->data_fim_categoria = $request->data_fim_categoria;
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
            'nome_categoria' => 'required|string|max:255',
            'descricao' => 'string',
            'ind_ativo' => 'required|boolean'
        ]);

        $category = Category::findOrFail($id);

        $category->nome_categoria = $request->input('nome_categoria');
        $category->descricao = $request->input('descricao');
        $category->ind_ativo = $request->input('ind_ativo');

        if ($request->ind_ativo) {
            $category->data_fim_categoria = null;
        } else {
            $category->data_fim_categoria = now();
        }

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
        $category->data_fim_categoria = now();
        $category->save();

        return redirect()->route('category.index')->with('success', 'Categoria desativada com sucesso!');
    }

    public function show($id)
    {
        $categoria = Category::find($id);
        return view('category.show', compact('categoria'));
    }
}
