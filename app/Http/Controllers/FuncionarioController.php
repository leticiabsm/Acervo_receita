<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;


class FuncionarioController extends Controller
{
    public function index(Request $request)
    {

        $query = Funcionario::with('cargo');

        if ($request->has('pesquisa') && $request->pesquisa) {
            $query->where('nome', 'ilike', '%' . $request->pesquisa . '%');
            // Use 'like' se for MySQL, 'ilike' para Postgres
        }

        $funcionarios = $query->get();
        return view('funcionarios.index', compact('funcionarios'));
    }


    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $funcionario->nome = $request->input('nome');
        $funcionario->nome_fantasia = $request->input('nome_fantasia');
        $funcionario->cargo_id = $request->input('cargo_id');
        $funcionario->salario = $request->input('salario');
        $funcionario->rg = $request->input('rg');
        $funcionario->data_inicio = $request->input('data_inicio'); // Aqui está a correção!

        if ($request->status === 'ativo') {
            $funcionario->data_finalizacao = null;
        } else {
            $funcionario->data_finalizacao = now();
        }

        $funcionario->save();

        return redirect()->route('funcionarios.lista')->with('success', 'Funcionário atualizado!');
    }

    public function show($id)
    {
        $funcionario = Funcionario::with('cargo')->findOrFail($id);
        return view('funcionarios.show', compact('funcionario'));
    }


    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $cargos = \App\Models\Cargo::all(); // Se quiser mostrar cargos em um select

        return view('funcionarios.edit', compact('funcionario', 'cargos'));
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->data_finalizacao = now();
        $funcionario->save();

        return response()->json([
            'status' => 'INATIVO',
            'message' => 'Funcionário inativado com sucesso.'
        ]);
    }


    public function reativar($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->data_finalizacao = null;
        $funcionario->save();

        return response()->json([
            'status' => 'ATIVO',
            'message' => 'Funcionário reativado com sucesso.'
        ]);
    }


    public function confirmDelete($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionarios.confirmDelete', compact('funcionario'));
    }
}
