<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
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
        $categoria->desc = $request->desc;
        $categoria->dt_ini_cat = now();
        $categoria->dt_fim_cat = null;
        $categoria->ativo = $request->ativo ?? true;

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
            'desc' => 'nullable|string',
            'ativo' => 'required|boolean'
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->nome_cat = $request->input('nome_cat');
        $categoria->desc = $request->input('desc');
        $categoria->ativo = $request->input('ativo');

        $categoria->dt_fim_cat = $categoria->ativo ? null : now();

        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function delete($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.delete', compact('categoria'));
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->ativo = 0;
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
