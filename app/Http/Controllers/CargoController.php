<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function showAdicionar()
    {
        return view('cargos.adicionar');
    }
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargos.index', compact('cargos'));
    }
    public function salvar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:cargos,nome',
            'descricao' => 'nullable|string|max:255',
            'data_inicio' => 'nullable|date',
        ]);

        Cargo::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio ?? now()->toDateString(),
            'ativo' => 1,
        ]);

        return redirect()->back()->with('success', 'Cargo adicionado com sucesso!');
    }
}
