<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente; // Certifique-se de que o Model importado é 'Ingrediente'
use Illuminate\Http\Request; // Importe a classe Request

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * Exibe uma lista de todos os ingredientes, com funcionalidade de pesquisa.
     */
    public function index(Request $request) // Agora, o método recebe a instância de Request
    {
        // Inicia uma nova query para o modelo Ingrediente
        $query = Ingrediente::query();

        // Verifica se há um termo de pesquisa ('search') na requisição
        if ($request->has('search')) {
            $searchTerm = $request->input('search'); // Pega o valor do campo de pesquisa

            // Adiciona condições 'WHERE' para filtrar por nome ou descrição
            // O operador 'like' com '%' permite buscar por ocorrências parciais
            $query->where('nome', 'like', '%' . $searchTerm . '%')
                ->orWhere('descricao', 'like', '%' . $searchTerm . '%');
        }

        // Executa a query para obter os ingredientes (filtrados ou todos, se não houver pesquisa)
        $ingredientes = $query->get();

        // Retorna a view 'ingredientes.index' e passa a coleção de ingredientes para ela
        return view('ingredientes.index', compact('ingredientes'));
    }

    /**
     * Show the form for creating a new resource.
     * Exibe o formulário para criar um novo ingrediente.
     */
    public function create()
    {
        return view('ingredientes.create');
    }


    /**
     * Store a newly created resource in storage.
     * Armazena um novo ingrediente no banco de dados.
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos da requisição POST
        $request->validate([
            'nome' => 'required|string|max:45', // Nome é obrigatório, string e no máximo 45 caracteres
            'descricao' => 'nullable|string|max:1000', // Descrição é opcional, string e no máximo 1000 caracteres
        ]);

        // Cria um novo registro na tabela 'gmg_ingredientes' usando o Model Ingrediente
        Ingrediente::create([
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao'),
        ]);

        // Redireciona o usuário para a rota 'ingredientes.index'
        // e adiciona uma mensagem de sucesso na sessão flash
        return redirect()->route('ingredientes.index')
            ->with('success', 'Ingrediente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     * Exibe os detalhes de um ingrediente específico.
     *
     * @param  \App\Models\Ingrediente  $ingrediente  (Laravel automaticamente injeta a instância do Model)
     */
    public function show(Ingrediente $ingrediente)
    {
        // O Laravel já injetou o objeto Ingrediente correspondente ao ID na URL.
        // Adicionalmente, carregamos as medidas associadas para a view show.
        $ingrediente->load('medidas'); // Garante que as medidas relacionadas sejam carregadas

        // Basta passar este objeto para a view 'ingredientes.show'.
        return view('ingredientes.show', compact('ingrediente'));
    }

    /**
     * Show the form for editing the specified resource.
     * Exibe o formulário para editar um ingrediente existente.
     *
     * @param  \App\Models\Ingrediente  $ingrediente  (Laravel automaticamente injeta a instância do Model)
     */
    public function edit(Ingrediente $ingrediente)
    {
        // O Laravel já injetou o objeto Ingrediente correspondente ao ID na URL.
        // Basta passar este objeto para a view 'ingredientes.edit'.
        return view('ingredientes.edit', compact('ingrediente'));
    }

    /**
     * Update the specified resource in storage.
     * Atualiza um ingrediente existente no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request  A requisição HTTP contendo os novos dados
     * @param  \App\Models\Ingrediente  $ingrediente  A instância do Model Ingrediente a ser atualizada
     */
    public function update(Request $request, Ingrediente $ingrediente)
    {
        // Valida os dados recebidos da requisição PUT/PATCH
        $request->validate([
            'nome' => 'required|string|max:45',
            'descricao' => 'nullable|string|max:1000',
        ]);

        // Atualiza os atributos do objeto ingrediente com os dados da requisição
        // e salva as alterações no banco de dados.
        $ingrediente->update([
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao'),
        ]);

        // Redireciona o usuário para a rota 'ingredientes.index'
        // e adiciona uma mensagem de sucesso na sessão flash
        return redirect()->route('ingredientes.index')
            ->with('success', 'Ingrediente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * Remove um ingrediente do banco de dados.
     *
     * @param  \App\Models\Ingrediente  $ingrediente  A instância do Model Ingrediente a ser removida
     */
    public function destroy(Ingrediente $ingrediente)
    {
        // Deleta o registro do ingrediente do banco de dados
        $ingrediente->delete();

        // Redireciona o usuário para a rota 'ingredientes.index'
        // e adiciona uma mensagem de sucesso na sessão flash
        return redirect()->route('ingredientes.index')
            ->with('success', 'Ingrediente excluído com sucesso!');
    }
}
