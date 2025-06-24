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
}
