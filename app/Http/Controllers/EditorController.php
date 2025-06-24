<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function dashboard()
    {
        // Aqui você pode buscar do banco ou definir valores fictícios
        $totalReceitas = 0;
        $totalPublicacao = 0;
        $totalDegustacao = 0;

        return view('dashboard.editor', compact('totalReceitas', 'totalPublicacao', 'totalDegustacao'));
    }
}