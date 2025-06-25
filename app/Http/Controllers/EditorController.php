<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function dashboard()
    {
        // Total de receitas criadas (todas do sistema)
        $totalReceitas = \App\Models\Receita::count();

        // Total de livros publicados (ajuste o campo conforme sua tabela de livros)
        $totalPublicacao = \App\Models\Livro::where('publicado', true)->count();

        // Total de receitas aguardando degustação (status nulo ou diferente de 'Avaliada')
        $totalDegustacao = \App\Models\Receita::where(function ($query) {
            $query->whereNull('status')
                ->orWhere('status', '!=', 'Avaliada');
        })->count();

        return view('dashboard.editor', compact('totalReceitas', 'totalPublicacao', 'totalDegustacao'));
    }
}
