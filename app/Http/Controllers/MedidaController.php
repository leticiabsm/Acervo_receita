<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medidas = Medida::all();
        return view('medidas.index', compact('medidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medidas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Novas regras de validação para as colunas 'tipo', 'item' e 'descricao'
        $request->validate([
            'tipo'      => 'required|string|max:45',
            'item'      => 'required|string|max:45',
            'descricao' => 'required|string|max:20', // Certifique-se que o nome 'descricao' corresponde à sua nova coluna de quantidade
        ]);

        // Criação do registro com as novas colunas
        Medida::create([
            'tipo'      => $request->input('tipo'),
            'item'      => $request->input('item'),
            'descricao' => $request->input('descricao'),
        ]);

        return redirect()->route('medidas.index')
                         ->with('success', 'Medida criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medida $medida)
    {
        return view('medidas.show', compact('medida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medida $medida)
    {
        return view('medidas.edit', compact('medida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medida $medida)
    {
        // Novas regras de validação para as colunas 'tipo', 'item' e 'descricao'
        $request->validate([
            'tipo'      => 'required|string|max:45',
            'item'      => 'required|string|max:45',
            'descricao' => 'required|string|max:20', // Certifique-se que o nome 'descricao' corresponde à sua nova coluna de quantidade
        ]);

        // Atualização do registro com as novas colunas
        $medida->update([
            'tipo'      => $request->input('tipo'),
            'item'      => $request->input('item'),
            'descricao' => $request->input('descricao'),
        ]);

        return redirect()->route('medidas.index')
                         ->with('success', 'Medida atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medida $medida)
    {
        $medida->delete();

        return redirect()->route('medidas.index')
                         ->with('success', 'Medida excluída com sucesso!');
    }
}