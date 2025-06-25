<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Categoria::query();
    
        if ($request->filled('searchInput')) {
            $query->where('nome_cat', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('descricao_cat', 'like', '%' . $request->searchInput . '%');
        }
    
        $categorias = $query->get();
    
        return view('categorias.index', compact('categorias'));
    }
    

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $categoria = new Categoria();

        $categoria->nome_cat = $request->nome_cat;
        $categoria->descricao_cat = $request->descricao_cat;
        $categoria->dt_ini_cat = now();
        $categoria->dt_fim_cat = null;

        $categoria->ind_ativo = $request->input('ativo', 1);


        $categoria->save();

        return redirect()->route('categorias.index')->with('msg', 'Categoria criada com sucesso!');
    }


    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_cat' => 'required|string|max:255',
            'descricao_cat' => 'nullable|string',
            'ind_ativo' => 'required|boolean'
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->nome_cat = $request->input('nome_cat');
        $categoria->descricao_cat = $request->input('descricao_cat');
        $categoria->ind_ativo = $request->input('ind_ativo');

        $categoria->dt_fim_cat = $categoria->ind_ativo ? null : now();

        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function delete($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.destroy', compact('categoria'));
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->ind_ativo = 0;
        $categoria->dt_fim_cat = now();
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria desativada com sucesso!');
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.show', compact('categoria'));
    }
}
