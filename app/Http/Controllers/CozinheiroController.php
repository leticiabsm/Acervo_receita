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

        // Total de receitas criadas por este cozinheiro
        $totalReceitas = $cozinheiro ? $cozinheiro->receitas()->count() : 0;

        // Só conta receitas deste cozinheiro aguardando degustação
        $totalPedidos = 0;
        if ($cozinheiro) {
            $totalPedidos = Receita::where('FKcozinheiro', $cozinheiro->id)
                ->where(function ($query) {
                    $query->whereNull('status')
                        ->orWhere('status', '!=', 'Avaliada');
                })
                ->count();
        }

        return view('dashboard.cozinheiro', compact('totalReceitas', 'totalPedidos'));
    }
}
