<?php

namespace App\Http\Controllers;

use App\Models\LivroPublicado;
use App\Models\Livro;
use App\Models\Funcionario;
use App\Models\Degustacao;

use Illuminate\Http\Request;

class LivroPublicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livros = LivroPublicado::with(['funcionario', 'nota'])->get();

    return view('publicacao.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $livros = Livro::all();
        $funcionarios = Funcionario::all();
        $notas = Degustacao::all();
    
        return view('publicacao.create', [
            'livros' => $livros,
            'funcionarios' => $funcionarios,
            'notas' => $notas,
            'livroPublicado' => null // importante para o _form saber que é um novo
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LivroPublicado $livroPublicado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LivroPublicado $livroPublicado)
    {
        $livros = Livro::all();
        $funcionarios = Funcionario::all();
        $notas = Degustacao::all();
    
        return view('publicacao.edit', [
            'livroPublicado' => $livroPublicado,
            'livros' => $livros,
            'funcionarios' => $funcionarios,
            'notas' => $notas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LivroPublicado $livroPublicado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LivroPublicado $livroPublicado)
    {
        //
    }
}
