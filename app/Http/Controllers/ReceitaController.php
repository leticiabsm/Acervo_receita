<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Ingrediente; // Precisaremos para os formulários
use App\Models\Medida;     // Precisaremos para os formulários
use App\Models\Categoria;  // Precisaremos para os formulários
use App\Models\Funcionario; // Precisaremos para os formulários

use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Para validações mais avançadas

class ReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     * Exibe uma lista de todas as receitas, com funcionalidade de pesquisa.
     */
    public function index(Request $request)
    {
        $query = Receita::query();

        // Verifica se há um termo de pesquisa ('search') na requisição
        if ($request->has('search')) {
            $searchTerm = $request->input('search');

            // Filtra por nome da receita ou instruções
            $query->where('nome_rec', 'like', '%' . $searchTerm . '%')
                  ->orWhere('preparo', 'like', '%' . $searchTerm . '%');
        }

        // Carrega os relacionamentos necessários para a exibição na lista (cozinheiro e categoria)
        $receitas = $query->with(['cozinheiro', 'categoria'])->get();

        return view('receitas.index', compact('receitas'));
    }//fim index

             //create
     public function create()
    {
        // Precisamos de todos os ingredientes e medidas para os dropdowns dinâmicos
        $ingredientes = Ingrediente::all();
        $medidas = Medida::all();
        $categorias = Categoria::where('ind_ativo', 1)->get(); // Apenas categorias ativas
        $cozinheiros = Funcionario::where('ind_funcionario', 1)
                                   ->whereHas('cargo', function ($query) {
                                       $query->where('nome', 'Cozinheiro'); // Filtra por cargo "Cozinheiro"
                                   })
                                   ->get(); // Apenas funcionários ativos que são cozinheiros

        return view('receitas.create', compact('ingredientes', 'medidas', 'categorias', 'cozinheiros'));
    }//fim create

    //store
    public function store(Request $request)
    {
        // 1. Validação dos dados da Receita principal
        $validatedData = $request->validate([
            'nome_rec'             => 'required|string|max:45',
            'FKcozinheiro'         => 'required|exists:gmg_cadastro_de_funcionario,FK_idFuncionario',
            'FKCategoria'          => 'required|exists:gmg_categoria,idCategoria',
            // 'idReceitas'           => 'required|integer|unique:gmg_receitas,idReceitas', // Remova se idReceitas for AUTO_INCREMENT
            'dt_criacao'           => 'required|date',
            'preparo'              => 'required|string|max:5000',
            'quat_porcao'          => 'required|numeric|min:0.1',
            'ind_rec_inedita'      => 'required|in:S,N',
            'dificudade_receitas'  => 'required|string|max:12', // Ex: fácil, médio, difícil
            'tempo_de_preparo'     => 'required|date_format:H:i:s', // Formato H:i:s (ex: 01:30:00)
            'ingredientes_receita' => 'nullable|array', // Array de ingredientes para a receita
            'ingredientes_receita.*.idIngrediente' => 'required_with:ingredientes_receita|exists:gmg_ingredientes,idIngrediente',
            'ingredientes_receita.*.idMedida'      => 'required_with:ingredientes_receita|exists:gmg_medidas,idMedida',
            'ingredientes_receita.*.quantidade'    => 'required_with:ingredientes_receita|numeric|min:0.01',
            'ingredientes_receita.*.observacao'    => 'nullable|string|max:255',
        ]);

        // Se idReceitas for AUTO_INCREMENT no banco de dados, NÃO inclua-o no fillable do modelo
        // e remova-o do $validatedData antes de criar a receita
        // Se idReceitas for manual, certifique-se que ele é validado e está presente.
        // Assumindo que idReceitas é AUTO_INCREMENT ou gerado automaticamente:
        // Remova $validatedData['idReceitas'] se ele veio do formulário e o banco gera automaticamente.

        // Cria a receita
        $receita = Receita::create([
            'nome_rec'             => $validatedData['nome_rec'],
            'FKcozinheiro'         => $validatedData['FKcozinheiro'],
            'FKCategoria'          => $validatedData['FKCategoria'],
            // 'idReceitas'           => $validatedData['idReceitas'], // Remova se for auto-increment
            'dt_criacao'           => $validatedData['dt_criacao'],
            'preparo'              => $validatedData['preparo'],
            'quat_porcao'          => $validatedData['quat_porcao'],
            'ind_rec_inedita'      => $validatedData['ind_rec_inedita'],
            'dificudade_receitas'  => $validatedData['dificudade_receitas'],
            'tempo_de_preparo'     => $validatedData['tempo_de_preparo'],
        ]);

        // 2. Anexa os ingredientes à receita através da tabela pivô
        if (isset($validatedData['ingredientes_receita'])) {
            foreach ($validatedData['ingredientes_receita'] as $ingredienteData) {
                // Prepara os dados para a tabela pivô
                $pivotData = [
                    'idMedida'   => $ingredienteData['idMedida'],
                    'quantidade' => $ingredienteData['quantidade'],
                    'observacao' => $ingredienteData['observacao'] ?? null,
                ];

                // Anexa o ingrediente à receita com os dados da tabela pivô
                // Usamos attach() para adicionar novos registros.
                // IMPORTANTE: Se a combinação (idReceita, idIngrediente, idMedida) já existe,
                // attach() vai disparar um erro de PK duplicada.
                // Você pode usar syncWithoutDetaching para evitar isso ou verificar antes.
                // Mas a validação de required_with já deve ajudar a evitar submissões vazias.
                $receita->ingredientes()->attach($ingredienteData['idIngrediente'], $pivotData);
            }
        }

        return redirect()->route('receitas.index')
                         ->with('success', 'Receita criada com sucesso!');
    } //fim store

    //show
    public function show(Receita $receita)
    {
        // Carrega os relacionamentos com cozinheiro, categoria e ingredientes (com suas medidas)
        $receita->load(['cozinheiro', 'categoria', 'ingredientes.medidas']); // Carrega medidas dos ingredientes

        // Para cada ingrediente, precisamos do objeto Medida real, não apenas o idMedida do pivô.
        // O withPivot('idMedida') traz apenas o ID, mas o with('ingredientes.medidas') já faz a carga.
        // Podemos precisar de um ajuste na view ou uma função acessor no modelo para Medida.
        // Uma forma de pegar a medida para cada ingrediente na pivot:
        $ingredientesComMedidas = [];
        foreach ($receita->ingredientes as $ingrediente) {
            // Acessa a medida real usando o idMedida do pivô
            $medidaReal = Medida::find($ingrediente->pivot->idMedida);
            $ingredientesComMedidas[] = (object) [
                'ingrediente' => $ingrediente,
                'medida'      => $medidaReal,
                'quantidade'  => $ingrediente->pivot->quantidade,
                'observacao'  => $ingrediente->pivot->observacao,
            ];
        }


        return view('receitas.show', compact('receita', 'ingredientesComMedidas'));
    }
    public function edit(Receita $receita)
    {
        $ingredientes = Ingrediente::all();
        $medidas = Medida::all();
        $categorias = Categoria::where('ind_ativo', 1)->get();
        $cozinheiros = Funcionario::where('ind_funcionario', 1)
                                   ->whereHas('cargo', function ($query) {
                                       $query->where('nome', 'Cozinheiro');
                                   })
                                   ->get();

        // Carrega os ingredientes já associados à receita com os dados da tabela pivô
        // e também as medidas associadas a esses ingredientes através do pivot.
        $receita->load(['ingredientes' => function ($query) {
            $query->withPivot('idMedida', 'quantidade', 'observacao');
        }]);

        // Para facilitar a preenchimento do formulário, podemos formatar os ingredientes existentes
        $ingredientesReceita = [];
        foreach ($receita->ingredientes as $ingrediente) {
            $ingredientesReceita[] = [
                'idIngrediente' => $ingrediente->idIngrediente,
                'idMedida'      => $ingrediente->pivot->idMedida,
                'quantidade'    => $ingrediente->pivot->quantidade,
                'observacao'    => $ingrediente->pivot->observacao,
            ];
        }

        return view('receitas.edit', compact('receita', 'ingredientes', 'medidas', 'categorias', 'cozinheiros', 'ingredientesReceita'));
    }// Fim show

    //Update
    public function update(Request $request, Receita $receita)
    {
        // 1. Validação dos dados da Receita principal
        $validatedData = $request->validate([
            'nome_rec'             => 'required|string|max:45',
            'FKcozinheiro'         => 'required|exists:gmg_cadastro_de_funcionario,FK_idFuncionario',
            'FKCategoria'          => 'required|exists:gmg_categoria,idCategoria',
            'dt_criacao'           => 'required|date',
            'preparo'              => 'required|string|max:5000',
            'quat_porcao'          => 'required|numeric|min:0.1',
            'ind_rec_inedita'      => 'required|in:S,N',
            'dificudade_receitas'  => 'required|string|max:12',
            'tempo_de_preparo'     => 'required|date_format:H:i:s',
            'ingredientes_receita' => 'nullable|array',
            'ingredientes_receita.*.idIngrediente' => 'required_with:ingredientes_receita|exists:gmg_ingredientes,idIngrediente',
            'ingredientes_receita.*.idMedida'      => 'required_with:ingredientes_receita|exists:gmg_medidas,idMedida',
            'ingredientes_receita.*.quantidade'    => 'required_with:ingredientes_receita|numeric|min:0.01',
            'ingredientes_receita.*.observacao'    => 'nullable|string|max:255',
        ]);

        // 2. Atualiza os dados da Receita principal
        $receita->update([
            'nome_rec'             => $validatedData['nome_rec'],
            'FKcozinheiro'         => $validatedData['FKcozinheiro'],
            'FKCategoria'          => $validatedData['FKCategoria'],
            'dt_criacao'           => $validatedData['dt_criacao'],
            'preparo'              => $validatedData['preparo'],
            'quat_porcao'          => $validatedData['quat_porcao'],
            'ind_rec_inedita'      => $validatedData['ind_rec_inedita'],
            'dificudade_receitas'  => $validatedData['dificudade_receitas'],
            'tempo_de_preparo'     => $validatedData['tempo_de_preparo'],
        ]);

        // 3. Sincroniza os ingredientes na tabela pivô
        // O método sync() é poderoso para gerenciar Many-to-Many
        // Ele vai adicionar/atualizar/remover relacionamentos conforme o array fornecido.
        $ingredientesToSync = [];
        if (isset($validatedData['ingredientes_receita'])) {
            foreach ($validatedData['ingredientes_receita'] as $ingredienteData) {
                // A chave do array externo para sync() deve ser o ID do item relacionado
                // O valor deve ser um array associativo com os dados do pivot
                // IMPORTANTE: Se a combinação de PKs compostas (idReceita, idIngrediente, idMedida)
                // for violada, sync() pode não ser suficiente, e você precisará de uma lógica manual
                // de attach/updateExistingPivot/detach.
                // Como nossa PK na tabela pivô é (idReceita, idIngrediente, idMedida),
                // precisamos que o sync entenda isso.
                // Sync por padrão só funciona com IDs de um lado.
                // Para chaves compostas na pivot, é mais seguro usar detach/attach ou sync sem IDs de pivot.

                // Uma abordagem mais segura para PK composta no pivot:
                // Primeiro, removemos todos os ingredientes atuais para esta receita.
                $receita->ingredientes()->detach();
            }

            // Depois, anexamos os novos/atualizados
            foreach ($validatedData['ingredientes_receita'] as $ingredienteData) {
                 $receita->ingredientes()->attach(
                    $ingredienteData['idIngrediente'],
                    [
                        'idMedida'   => $ingredienteData['idMedida'],
                        'quantidade' => $ingredienteData['quantidade'],
                        'observacao' => $ingredienteData['observacao'] ?? null,
                    ]
                );
            }
        } else {
            // Se nenhum ingrediente for enviado, desanexa todos os existentes
            $receita->ingredientes()->detach();
        }

        return redirect()->route('receitas.index')
                         ->with('success', 'Receita atualizada com sucesso!');
    } //Fim Update

    //Destroy
    public function destroy(Receita $receita)
    {
        $receita->delete(); // Isso também removerá os registros da tabela pivô se onDelete('cascade') estiver configurado

        return redirect()->route('receitas.index')
                         ->with('success', 'Receita excluída com sucesso!');
    }//fim destroy
}