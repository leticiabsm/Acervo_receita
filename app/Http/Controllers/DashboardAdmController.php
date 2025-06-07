<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Cargo;
use App\Models\Receita;
use App\Models\Livro;
use App\Models\Restaurante;

class DashboardAdmController extends Controller
{

    public function dashboardAdm()
    {
        if (!session('admin_logged_in') || !session('funcionario_id')) {
            return redirect()->route('login');
        }
        $totalFuncionarios = Funcionario::count();
        $totalCargos = Cargo::count();

        return view('dashboard_adm', compact('totalFuncionarios', 'totalCargos'));
    }
}
