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


    public function cozinheiro()
    {
        return view('dashboard.cozinheiro');
    }
    public function editor()
    {
        return view('dashboard.editor');
    }
    
}
