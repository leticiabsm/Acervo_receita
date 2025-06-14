<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Cargo;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', [
            'totalFuncionarios' => Funcionario::count(),
            'totalCargos' => Cargo::count(),
        ]);
    }

    public function funcionario()
    {
        return view('dashboard.funcionario');
    }
}
