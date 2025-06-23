<?php

namespace App\Http\Controllers;


use App\Models\Cozinheiro;
use Illuminate\Http\Request;
use App\Models\Receita;
use App\Models\Degustacao;
use Illuminate\Support\Facades\Auth;
use App\Models\Funcionario;

class CozinheiroController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Busca o funcionário com cargo de cozinheiro
        $cozinheiro = Funcionario::where('id', $user->id)
            ->whereHas('cargo', function ($q) {
                $q->where('nome', 'Cozinheiro');
            })->first();

        $totalReceitas = $cozinheiro ? $cozinheiro->receitas()->count() : 0;

        $totalPedidos = 0;
        if ($cozinheiro) {
            $totalPedidos = Degustacao::whereHas('receita', function ($q) use ($cozinheiro) {
                $q->where('FKcozinheiro', $cozinheiro->id);
            })->count();
        }

        return view('dashboard.cozinheiro', compact('totalReceitas', 'totalPedidos'));
    }
}
