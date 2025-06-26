<?php

namespace App\Http\Controllers;

use App\Models\Degustacao;
use App\Models\Receita;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DegustacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $degustacoes = Degustacao::with('receita')
            ->when($search, function ($query, $search) {
                $query->where('FKReceita', 'like', "%$search%")
                    ->orWhere('data_degustacao', 'like', "%$search%");
            })
            ->orderBy('data_degustacao', 'desc')
            ->get();

        return view('notas.degustacao', compact('degustacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            return $this->search($request);
        }

        $receita = Receita::whereNotIn('idReceitas', function ($query) {
            $query->select('FKReceita')->from('gmg_degustacao');
        })->first();

        if (!$receita) {
            return redirect()->route('degustacao.index')
                ->with('msg', 'Não há receitas disponíveis para degustação.')->with('alert-type', 'warning');
        }

        return view('notas.create', ['receita' => $receita, 'search' => $search]);
    }

    /**
     * Search for a recipe not yet evaluated.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $receita = Receita::where('nome_rec', 'like', "%$search%")
            ->whereNotIn('idReceitas', function ($query) {
                $query->select('FKReceita')->from('gmg_degustacao');
            })
            ->first();

        if (!$receita) {
            return redirect()->route('degustacao.create')
                ->with('msg', 'Não há receitas disponíveis para degustação com esse nome.')->with('alert-type', 'warning');
        }

        return view('notas.create', ['receita' => $receita, 'search' => $search]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'FKReceita' => 'required|integer|exists:gmg_receitas,idReceitas',
            'nota_degustacao' => 'required|numeric|min:0|max:10',
            'FKcozinheiro' => 'required|integer|exists:gmg_receitas,FKcozinheiro',
            'descricao' => 'required|string|max:1000',
        ]);

        $avaliacaoExistente = Degustacao::where('FKReceita', $request->FKReceita)->exists();

        if ($avaliacaoExistente) {
            return redirect()->route('degustacao.index')
                ->with('msg', 'Esta receita já foi avaliada anteriormente.')->with('alert-type', 'warning');
        }

        $avaliacao = new Degustacao();
        $avaliacao->FKReceita = $request->FKReceita;
        $avaliacao->nota_degustacao = $request->nota_degustacao;
        $avaliacao->data_degustacao = now();
        $avaliacao->FKcozinheiro = $request->FKcozinheiro;
        $avaliacao->descricao = $request->descricao;
        $avaliacao->FK_degustador = Auth::id();


        $avaliacao->save();

        return redirect()->route('degustacao.index')
            ->with('msg', 'Receita avaliada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $degustacao = Degustacao::findOrFail($id);
        return view('notas.show', compact('degustacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $degustacao = Degustacao::findOrFail($id);
        return view('notas.edit', compact('degustacao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nota_degustacao' => 'required|numeric|min:0|max:10',
            'descricao' => 'nullable|string|max:1000',
        ]);

        $degustacao = Degustacao::findOrFail($id);
        $degustacao->nota_degustacao = $request->nota_degustacao;
        $degustacao->descricao = $request->descricao;
        $degustacao->save();

        return redirect()->route('degustacao.index')->with('msg', 'Nota atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $degustacao = Degustacao::findOrFail($id);
        $degustacao->delete();
        return redirect()->route('degustacao.index')->with('msg', 'Degustação removida com sucesso!');
    }
}
