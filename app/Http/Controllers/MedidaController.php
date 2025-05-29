<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use Illuminate\Http\Request; // Importe a classe Request para acessar os dados da requisição

class MedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     * Exibe uma lista de todas as medidas, agora com funcionalidade de pesquisa.
     */
    public function index(Request $request) // O método index agora recebe a instância de Request
    {
        // Inicia uma nova query para o modelo Medida
        $query = Medida::query();

        // Verifica se há um termo de pesquisa ('search') na requisição
        if ($request->has('search')) {
            $searchTerm = $request->input('search'); // Pega o valor do campo de pesquisa

            // Adiciona condições 'WHERE' para filtrar por 'tipo', 'item' ou 'descricao'
            // O operador 'like' com '%' permite buscar por ocorrências parciais
            $query->where('tipo', 'like', '%' . $searchTerm . '%')
                  ->orWhere('item', 'like', '%' . $searchTerm . '%')
                  ->orWhere('descricao', 'like', '%' . $searchTerm . '%');
        }

        // Executa a query para obter as medidas (filtradas ou todas, se não houver pesquisa)
        $medidas = $query->get();

        // Retorna a view 'medidas.index' e passa a coleção de medidas para ela
        return view('medidas.index', compact('medidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medidas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Regras de validação para as colunas 'tipo', 'item' e 'descricao'
        $request->validate([
            'tipo'        => 'required|string|max:45',
            'item'        => 'required|string|max:45',
            'descricao'   => 'required|string|max:20', // Verifique se 'descricao' é para a quantidade
        ]);

        // Criação do registro com as novas colunas
        Medida::create([
            'tipo'        => $request->input('tipo'),
            'item'        => $request->input('item'),
            'descricao'   => $request->input('descricao'),
        ]);

        return redirect()->route('medidas.index')
                         ->with('success', 'Medida criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medida $medida)
    {
        // Se você precisar carregar ingredientes associados à medida nesta view,
        // adicione a linha abaixo (certifique-se de configurar o relacionamento no Medida model)
        // $medida->load('ingredientes');
        return view('medidas.show', compact('medida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medida $medida)
    {
        return view('medidas.edit', compact('medida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medida $medida)
    {
        // Regras de validação para as colunas 'tipo', 'item' e 'descricao'
        $request->validate([
            'tipo'        => 'required|string|max:45',
            'item'        => 'required|string|max:45',
            'descricao'   => 'required|string|max:45', // Verifique se 'descricao' é para a quantidade
        ]);

        // Atualização do registro com as novas colunas
        $medida->update([
            'tipo'        => $request->input('tipo'),
            'item'        => $request->input('item'),
            'descricao'   => $request->input('descricao'),
        ]);

        return redirect()->route('medidas.index')
                         ->with('success', 'Medida atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medida $medida)
    {
        $medida->delete();

        return redirect()->route('medidas.index')
                         ->with('success', 'Medida excluída com sucesso!');
    }
}