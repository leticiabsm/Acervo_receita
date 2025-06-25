<?php

namespace App\Http\Controllers;


use App\Models\Cozinheiro;
use Illuminate\Http\Request;
use App\Models\Receita;
use App\Models\Degustacao;
use Illuminate\Support\Facades\Auth;
use App\Models\Funcionario;

class DegustadorController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Busca o funcionário com cargo de cozinheiro
        $degustador = Funcionario::where('id', $user->id)
            ->whereHas('cargo', function ($q) {
                $q->where('nome', 'Degustador');
            })->first();

        $totalReceitas = $degustador ? $degustador->receitas()->count() : 0;

        $receitasParaAvaliar = 0;
        if ($degustador) {
            $receitasParaAvaliar = Degustacao::whereHas('receita', function ($q) use ($degustador) {
                $q->where('FK_degustador', $degustador->id);
            })->count();
        }

        return view('dashboard.degustador', compact('totalReceitas', 'receitasParaAvaliar'));
    }


    public function avaliarReceita(Request $request, $receitaId)
    {
        $degustadorId = Auth::id();

        // Verifica se já existe avaliação
        $jaAvaliada = Degustacao::where('receita_id', $receitaId)
            ->where('degustador_id', $degustadorId)
            ->exists();

        if (!$jaAvaliada) {
            Degustacao::create([
                'receita_id' => $receitaId,
                'degustador_id' => $degustadorId,
                // outros campos de avaliação, se houver
            ]);

            // Atualiza o status da receita para "Avaliada"
            Receita::where('idReceitas', $receitaId)
                ->update(['status' => 'Avaliada']);
        }

        return redirect()->back()->with('success', 'Receita avaliada com sucesso!');
    }
}
