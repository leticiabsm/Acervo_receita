<?php

namespace App\Http\Controllers;

use App\Models\LivroPublicado;
use App\Models\Livro;
use App\Models\Funcionario;
use App\Models\Degustacao;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class LivroPublicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $livros = LivroPublicado::with(['funcionario', 'degustacao'])->get();

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
        $categorias = Categoria::all(); // Buscando as categorias

        return view('publicacao.create', [
            'livros' => $livros,
            'funcionarios' => $funcionarios,
            'notas' => $notas,
            'categorias' => $categorias, // Passando para a view
            'livroPublicado' => null
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
    public function show($id)
    {
        $livroPublicado = LivroPublicado::findOrFail($id);
        return view('publicacao.form', compact('livroPublicado'));
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


    public function update(Request $request, LivroPublicado $livroPublicado)
    {
        //
    }


    public function destroy(LivroPublicado $livroPublicado)
    {
        //
    }

    public function visualizar($id)
    {
        $livroPublicado = LivroPublicado::with(['funcionario', 'degustacao'])->findOrFail($id);
        return view('publicacao.visualizar', compact('livroPublicado'));
    }

    public function pdf($id)
    {
        $livroPublicado = LivroPublicado::findOrFail($id);
        $pdf = Pdf::loadView('publicacao.pdf', compact('livroPublicado'));
        return $pdf->stream('livro_publicado.pdf');
    }
}
