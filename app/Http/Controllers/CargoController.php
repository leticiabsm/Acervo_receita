<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    // GET /cargos
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargos.index', compact('cargos'));
    }

    // GET /cargos/create
    public function create()
    {
        return view('cargos.adicionar');
    }

    // POST /cargos
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:gmg_cargo,nome',
            'descricao' => 'nullable|string|max:255',
            'data_inicio' => 'nullable|date',
        ]);

        Cargo::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio ?? now()->toDateString(),
            'ativo' => 1,
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo adicionado com sucesso!');
    }

    // GET /cargos/{id}
    public function show($id)
    {
        $cargo = Cargo::findOrFail($id);
        return view('cargos.show', compact('cargo')); // (Opcional, só se quiser exibir 1 cargo)
    }

    // GET /cargos/{id}/edit
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        return view('cargos.edit', compact('cargo'));
    }

    // PUT /cargos/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:gmg_cargo,nome,' . $id,
            'descricao' => 'nullable|string|max:255',
            'data_inicio' => 'nullable|date',
            'data_finalizacao' => 'nullable|date',
            'ativo' => 'required|boolean',
        ]);

        $cargo = Cargo::findOrFail($id);
        $cargo->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
            'data_finalizacao' => $request->data_finalizacao,
            'ativo' => $request->ativo,
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo atualizado com sucesso!');
    }

    // INATIVAR /cargos/{id}
    public function destroy($id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->update([
            'ativo' => 0,
            'data_finalizacao' => now()->toDateString(),
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo inativado com sucesso!');
    }


    public function status($id)
    {
        $cargo = Cargo::findOrFail($id);
        return view('cargos.status', compact('cargo'));
    }

    public function atualizarStatus(Request $request, $id)
    {
        $request->validate([
            'ativo' => 'required|boolean',
        ]);

        $cargo = Cargo::findOrFail($id);
        $cargo->ativo = $request->ativo;
        $cargo->save();

        return redirect()->route('cargos.index')->with('success', 'Status do cargo atualizado com sucesso.');
    }
}
