<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro; // Importa o modelo Livro

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livros = Livro::all();
        return view('livros.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Livro::create($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $titulo)
    {
        $livro = Livro::where('titulo', $titulo)->firstOrFail();
        return view('livros.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $livro = Livro::where('idlivro', $idlivro)->firstOrFail();
        return view('livros.edit', compact('livro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $titulo)
    {
        $livro = Livro::where('titulo', $titulo)->firstOrFail();
        $livro->update($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $livro = Livro::where('idlivro', $idlivro)->firstOrFail();
        $livro->delete();
        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}
