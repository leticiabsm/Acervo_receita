<?php

namespace App\Http\Controllers;

use App\Models\Degustacao;
use App\Models\Receita;
use Illuminate\Http\Request;

class DegustacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $degustacoes = Degustacao::query()
            ->when($search, function ($query, $search) {
                $query->where('FK_nome_rec', 'like', '%' . $search . '%')
                    ->orWhere('data_degustacao', 'like', '%' . $search . '%');
            })
            ->orderBy('FK_nome_rec', 'asc')
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
            // Chama o método que trata a busca
            return $this->search($request);
        }

        $degustacao = Degustacao::orderBy('FK_nome_rec', 'desc')->first();
        return view('notas.create', compact('degustacao', 'search'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        /**Após o merge, trocar a Model Degustacao para Receita */
        $receita = Receita::where('nome_rec', 'like', "%$search%")

            ->whereNotIn('nome_rec', function ($query) {
                $query->select('FK_nome_rec')
                    ->from('gmg_degustacao');
            })
            ->first();

        if (!$receita) {
            return redirect()->route('degustacao.create')->with('msg', 'Não há receitas disponíveis para degustação com esse nome.');
        }

        // Aqui você pode montar manualmente um objeto "fake" de degustacao ou adaptar a view
        return view('notas.create', [
            'degustacao' => (object)[
                'FK_nome_rec' => $receita->nome_rec,
                'FKcozinheiro' => $receita->FKcozinheiro,
                'tempo_de_preparo' => $receita->tempo_de_preparo,
            ],
            'search' => $search,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $avaliacaoExistente = Degustacao::where('FK_nome_rec', $request->FK_nome_rec)
            ->where('nota_degustacao', '>', 0)
            ->first();

        if ($avaliacaoExistente) {
            return redirect('/degustacao')
                ->with('msg', 'Esta receita já foi avaliada anteriormente.');
        }

        $avaliacao = new Degustacao();
        $avaliacao->FK_nome_rec = $request->FK_nome_rec;
        $avaliacao->nota_degustacao = $request->nota;
        $avaliacao->data_degustacao = now();
        $avaliacao->FKcozinheiro = $request->FKcozinheiro;
        $avaliacao->FK_degustador = $request->FK_degustador; 
        $avaliacao->save();

        return redirect('/degustacao')
            ->with('msg', 'Receita avaliada com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $degustacao = Degustacao::findOrfail($id);
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
            'nota_degustacao' => 'int'
        ]);

        $degustacao = Degustacao::findOrFail($id);

        $degustacao->nota_degustacao = $request->input('nota_degustacao');

        $degustacao->save();

        return redirect()->route('notas.index')->with('msg', 'Nota atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Degustacao $degustacao)
    {
        //
    }
}
