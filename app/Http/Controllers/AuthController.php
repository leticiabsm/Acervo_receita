<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Funcionario;
use App\Models\Cargo;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $funcionario = Funcionario::where('email', $credentials['email'])->first();

        if ($funcionario && Hash::check($credentials['password'], $funcionario->password)) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('funcionario_id', $funcionario->id);
            return redirect('/dashboard');
        }

        return back()->with('error', 'Credenciais inválidas.');
    }

    public function showCadastroForm()
    {
        $cargos = Cargo::where('ativo', true)->get();
        return view('auth.cadastro', compact('cargos'));
    }

    public function cadastrarFuncionario(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|unique:funcionarios,email',
            'password' => 'required|string|min:6|confirmed',
            'cargo_id' => 'required|exists:cargos,id',
            'rg' => 'nullable|string|max:30',
            'salario' => 'nullable|numeric',
            'data_inicio' => 'nullable|date',
            'data_finalizacao' => 'nullable|date',
            'nome_fantasia' => 'nullable|string|max:100',
        ]);

        Funcionario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password, // será criptografada pelo mutator
            'cargo_id' => $request->cargo_id,
            'rg' => $request->rg,
            'salario' => $request->salario,
            'data_inicio' => $request->data_inicio ?? now()->toDateString(),
            'data_finalizacao' => $request->data_finalizacao,
            'nome_fantasia' => $request->nome_fantasia,
        ]);

        return redirect()->route('login')->with('success', 'Funcionário cadastrado com sucesso!');
    }
}
