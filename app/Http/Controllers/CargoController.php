<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        return view('cargos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_cargo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
        ]);

        Cargo::create([
            'nome_cargo' => $request->nome_cargo,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio ?? now(),
            'data_fim' => $request->data_fim,
            'ind_ativo' => 1,
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo criado com sucesso.');
    }



    public function edit(Cargo $cargo)
    {
        return view('cargos.edit', compact('cargo'));
    }

    public function update(Request $request, Cargo $cargo)
    {
        $request->validate([
            'nome_cargo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
        ]);

        $dados = [
            'nome_cargo' => $request->nome_cargo,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
        ];

        if ($request->has('ind_ativo')) {
            $dados['ind_ativo'] = 1;
            $dados['data_fim'] = null;
        } else {
            $dados['ind_ativo'] = 0;
            $dados['data_fim'] = $request->data_fim;
        }

        // Preenche os dados no model, mas não salva ainda
        $cargo->fill($dados);

        if ($cargo->isDirty()) {
            $cargo->save();
            return redirect()->route('cargos.index')
                ->with('success', 'Cargo "' . $cargo->nome_cargo . '" atualizado com sucesso.')
                ->with('alert_type', 'success');
        } else {
            return redirect()->route('cargos.index')
                ->with('success', 'Nenhuma alteração foi feita.')
                ->with('alert_type', 'danger');
        }
    }


    public function destroy(Cargo $cargo)
    {
        $cargo->update([
            'ind_ativo' => 0,
            'data_fim' => now(),
        ]);

        return redirect()->route('cargos.index')
            ->with('success', 'Cargo "' . $cargo->nome_cargo . '" desativado com sucesso.')
            ->with('alert_type', 'danger');
    }
}
