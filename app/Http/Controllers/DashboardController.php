<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Cargo;
use App\Models\Receita;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', [
            'totalFuncionarios' => Funcionario::count(),
            'totalCargos' => Cargo::count(),
        ]);
    }


    public function dashboardEditor()
    {
        $user = Auth::user();
        $cargo = strtolower($user->cargo->nome ?? '');

        if (!in_array($cargo, ['editor', 'adm'])) {
            abort(403, 'Acesso não autorizado.');
        }

        // Exemplo de contagem (ajuste conforme seus modelos)
        $totalReceitas = Receita::count();
        $totalPublicacao = \App\Models\Livro::count();
        $totalDegustacao = Receita::where('status', 'aguardando degustacao')->count();

        return view('dashboard.editor', [
            'totalReceitas' => $totalReceitas,
            'totalPublicacao' => $totalPublicacao,
            'totalDegustacao' => $totalDegustacao,
        ]);
    }

    public function cozinheiro()
    {
        return view('dashboard.cozinheiro');
    }
}
