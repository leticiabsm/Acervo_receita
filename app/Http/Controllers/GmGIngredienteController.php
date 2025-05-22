<?php

namespace App\Http\Controllers;
use App\Models\GmGIngrediente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GmgIngredienteController extends Controller
{
    /**
     * Exibe uma listagem do recurso.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Use o nome do modelo corrigido aqui
        $ingredientes = GmGIngrediente::orderBy('nome')->paginate(10);
        return view('gmg_ingredientes.index', compact('ingredientes'));
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('gmg_ingredientes.create');
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
        $request->validate([
            'nome' => 'required|string|max:45|unique:GMG_Ingrediente,nome',
            'descricao' => 'nullable|string|max:1000',
        ]);

        // Use o nome do modelo corrigido aqui
        GmGIngrediente::create($request->all());

        // Redireciona para a lista de ingredientes com uma mensagem de sucesso.
        return redirect()->route('gmg_ingredientes.index')
                         ->with('success', 'Ingrediente criado com sucesso!');
    }

    /**
     * Exibe o recurso especificado.
     *
     * @param  \App\Models\GmGIngrediente  $gmGIngrediente // CORREÇÃO AQUI: Tipo do parâmetro deve ser o nome correto do modelo
     * @return \Illuminate\View\View
     */
    public function show(GmGIngrediente $gmGIngrediente)
    {
        return view('gmg_ingredientes.show', compact('gmGIngrediente'));
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     *
     * @param  \App\Models\GmGIngrediente  $gmGIngrediente // CORREÇÃO AQUI: Tipo do parâmetro deve ser o nome correto do modelo
     * @return \Illuminate\View\View
     */
    public function edit(GmGIngrediente $gmGIngrediente)
    {
        return view('gmg_ingredientes.edit', compact('gmGIngrediente'));
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GmGIngrediente  $gmGIngrediente // CORREÇÃO AQUI: Tipo do parâmetro deve ser o nome correto do modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, GmGIngrediente $gmGIngrediente)
    {
        // Valida os dados da requisição.
        $request->validate([
            'nome' => [
                'required',
                'string',
                'max:45',
                Rule::unique('GMG_Ingrediente', 'nome')->ignore($gmGIngrediente->idIngrediente, 'idIngrediente'),
            ],
            'descricao' => 'nullable|string|max:1000',
        ]);

        // Use o nome do modelo corrigido aqui
        $gmGIngrediente->update($request->all());

        // Redireciona para a lista de ingredientes com uma mensagem de sucesso.
        return redirect()->route('gmg_ingredientes.index')
                         ->with('success', 'Ingrediente atualizado com sucesso!');
    }

    /**
     * Remove o recurso especificado do armazenamento.
     *
     * @param  \App\Models\GmGIngrediente  $gmGIngrediente // CORREÇÃO AQUI: Tipo do parâmetro deve ser o nome correto do modelo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GmGIngrediente $gmGIngrediente)
    {
        // Exclui o ingrediente do banco de dados.
        $gmGIngrediente->delete();

        // Redireciona para a lista de ingredientes com uma mensagem de sucesso.
        return redirect()->route('gmg_ingredientes.index')
                         ->with('success', 'Ingrediente excluído com sucesso!');
    }
}