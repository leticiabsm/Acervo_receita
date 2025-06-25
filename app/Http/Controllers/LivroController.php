<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::all();
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $editor_nome = Auth::user()->nome; // ou 'name' se for o campo correto
        $receitas = \App\Models\Receita::all();
        $funcionarios = \App\Models\Funcionario::whereHas('cargo', function ($q) {
            $q->where('nome', 'Cozinheiro');
        })->get();

        return view('livros.create', compact('editor_nome', 'receitas', 'funcionarios'));
    }

    public function store(Request $request)
    {
        Livro::create($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    public function show($idlivro)
    {   
        $livro = Livro::with('receitas')->findOrFail($idlivro);
        return view('livros.show', compact('livro'));
    }


    public function edit($id)
    {
        $livro = Livro::findOrFail($id);
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);
        $livro->update($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($idlivro)
    {
        $livro = Livro::findOrFail($idlivro);
        return view('livros.destroy', compact('livro'));
    }


        public function destroyView($idlivro)
    {
        $livro = Livro::findOrFail($idlivro);
        return view('livros.destroy', compact('livro'));
    }


    public function download($idlivro)
    {
        $livro = Livro::with(['receitas', 'editor']) 
        
            ->findOrFail($idlivro);

        $pdf = Pdf::loadView('livros.pdf', compact('livro'));

        $filename = 'livro_' . $livro->idlivro . '.pdf';
        return $pdf->download($filename);
    }
}
