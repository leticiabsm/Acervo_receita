<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $categorias = Categoria::query()
            ->when($search, function ($query, $search) {
                $query->where('nome_categoria', 'like', '%' . $search . '%')
                    ->orWhere('descricao', 'like', '%' . $search . '%')
                    ->orWhere('data_inicio_categoria', 'like', '%' . $search . '%')
                    ->orWhere('data_fim_categoria', 'like', '%' . $search . '%')
                    ->orWhere('ind_ativo', 'like', '%' . $search . '%');
            })
            ->orderBy('nome_categoria', 'asc')
            ->get();

        return view('Categoria.categories', compact('categorias'));
    }


    

    public function create()
    {
        return view('Categoria.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $categoria = new Categoria();

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
        $Categoria = Categoria::findOrFail($id);
        return view('Categoria.edit', compact('Categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_categoria' => 'required|string|max:255',
            'descricao' => 'string',
            'ind_ativo' => 'required|boolean'
        ]);

        $Categoria = Categoria::findOrFail($id);

        $Categoria->nome_categoria = $request->input('nome_categoria');
        $Categoria->descricao = $request->input('descricao');
        $Categoria->ind_ativo = $request->input('ind_ativo');

        if ($request->ind_ativo) {
            $Categoria->data_fim_categoria = null;
        } else {
            $Categoria->data_fim_categoria = now();
        }

        $Categoria->save();

        return redirect()->route('Categoria.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function delete($id)
    {
        $Categoria = Categoria::findOrFail($id);
        return view('Categoria.delete', compact('Categoria'));
    }

    public function destroy($id)
    {

        $Categoria = Categoria::findOrFail($id);
        $Categoria->ind_ativo = 0;
        $Categoria->data_fim_categoria = now();
        $Categoria->save();

        return redirect()->route('Categoria.index')->with('success', 'Categoria desativada com sucesso!');
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);
        return view('Categoria.show', compact('categoria'));
    }
}
