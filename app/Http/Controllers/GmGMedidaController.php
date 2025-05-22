<?php

namespace App\Http\Controllers;

use App\Models\GmgMedida; // Importa o modelo GmgMedida
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Importa Rule para validação de unicidade

class GmgMedidaController extends Controller
{
    /**
     * Exibe uma listagem do recurso.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtém todas as medidas, ordenadas por descrição e com paginação.
        $medidas = GmgMedida::orderBy('decricao')->paginate(10);
        return view('gmg_medidas.index', compact('medidas'));
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('gmg_medidas.create');
    }

    /**
     * Armazena um recurso recém-criado no armazenamento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida os dados da requisição.
        // Note: A coluna 'decricao' foi usada conforme seu SQL.
        $request->validate([
            'decricao' => 'required|string|max:20|unique:GMG_Medida,decricao',
        ]);

        // Cria uma nova medida no banco de dados.
        GmgMedida::create($request->all());

        // Redireciona para a lista de medidas com uma mensagem de sucesso.
        return redirect()->route('gmg_medidas.index')
                         ->with('success', 'Medida criada com sucesso!');
    }

    /**
     * Exibe o recurso especificado.
     *
     * @param  \App\Models\GmgMedida  $gmgMedida
     * @return \Illuminate\View\View
     */
    public function show(GmgMedida $gmgMedida)
    {
        return view('gmg_medidas.show', compact('gmgMedida'));
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     *
     * @param  \App\Models\GmgMedida  $gmgMedida
     * @return \Illuminate\View\View
     */
    public function edit(GmgMedida $gmgMedida)
    {
        return view('gmg_medidas.edit', compact('gmgMedida'));
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GmgMedida  $gmgMedida
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, GmgMedida $gmgMedida)
    {
        // Valida os dados da requisição.
        // A regra 'unique' é ajustada para ignorar a própria medida que está sendo atualizada.
        // Note: A coluna 'decricao' foi usada conforme seu SQL.
        $request->validate([
            'decricao' => [
                'required',
                'string',
                'max:20',
                Rule::unique('GMG_Medida', 'decricao')->ignore($gmgMedida->idMedida, 'idMedida'),
            ],
        ]);

        // Atualiza a medida no banco de dados.
        $gmgMedida->update($request->all());

        // Redireciona para a lista de medidas com uma mensagem de sucesso.
        return redirect()->route('gmg_medidas.index')
                         ->with('success', 'Medida atualizada com sucesso!');
    }

    /**
     * Remove o recurso especificado do armazenamento.
     *
     * @param  \App\Models\GmgMedida  $gmgMedida
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GmgMedida $gmgMedida)
    {
        // Exclui a medida do banco de dados.
        $gmgMedida->delete();

        // Redireciona para a lista de medidas com uma mensagem de sucesso.
        return redirect()->route('gmg_medidas.index')
                         ->with('success', 'Medida excluída com sucesso!');
    }
}
