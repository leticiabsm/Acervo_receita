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

    // Exibe uma lista de todas as receitas, com funcionalidade de pesquisa.
    public function index()
    {
        $receitas = Receita::all(); // ou com filtros por cozinheiro, se quiser

        return view('receitas.index', compact('receitas'));
    }


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
    } //fim create

    //store
    public function store(Request $request)
    {
        // Regras de validação
        $rules = [
            'nome_rec'             => 'required|string|max:45',
            'FKcozinheiro'         => 'required|exists:funcionarios,id',

            'FKCategoria'          => 'required|exists:gmg_categoria,id_cat',
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
        ];

        // Mensagens personalizadas
        $messages = [
            'FKcozinheiro.required'     => 'O campo Cozinheiro é obrigatório.',
            'FKCategoria.required'      => 'A categoria é obrigatória.',
            'nome_rec.required'         => 'O nome da receita é obrigatório.',
            // (adicione outras mensagens se quiser)
        ];

        $validatedData = $request->validate($rules, $messages);

        // Criação da receita
        $receita = Receita::create([
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

        // Ingredientes da receita
        if (isset($validatedData['ingredientes_receita'])) {
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
        }

        return redirect()->route('receitas.index')
            ->with('success', 'Receita criada com sucesso!');
    } //Fim do store


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
    } // Fim show

    //Update
    public function update(Request $request, Receita $receita)
    {
        // 1. Validação dos dados da Receita principal
        $validatedData = $request->validate([
            'nome_rec'             => 'required|string|max:45',
            'FKcozinheiro'         => 'required|exists:funcionarios,id',
            'FKCategoria' => 'required|exists:gmg_categoria,id_cat',
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
    } //fim destroy
}
