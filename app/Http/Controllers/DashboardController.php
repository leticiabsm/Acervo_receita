<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Cargo;
use App\Models\Receita;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', [
            'totalFuncionarios' => Funcionario::count(),
            'totalCargos' => Cargo::count(),
        ]);
    }


    public function editor()
    {
        return view('dashboard.editor', [
            'totalReceitas' => Receita::count(),
            //'totalPublicacao' => Publicacao::count(),
            //'totalDegustacao' => Degustacao::count(),
        ]);


    public function cozinheiro()
    {
        return view('dashboard.cozinheiro');
    }
    
}
