<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\LivroPublicado;

class LivroDownloadController extends Controller
{
    public function download($id)
    {
        $livro = LivroPublicado::findOrFail($id);

        if (!$livro->arquivo_pdf) {
            return response()->json(['erro' => 'Arquivo não disponível'], 404);
        }

        $path = 'livros/' . $livro->arquivo_pdf;

        if (!Storage::disk('public')->exists($path)) {
            return response()->json(['erro' => 'Arquivo não encontrado no servidor'], 404);
        }

        return response()->download(storage_path("app/public/{$path}"), $livro->titulo . '.pdf');
    }
}
