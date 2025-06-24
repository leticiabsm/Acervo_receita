<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Funcionario;
use App\Models\Cargo;

class AuthController extends Controller
{
    // Mostra o formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validação rápida
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tenta autenticar usando o guard padrão, que espera que Funcionario seja o provider
        if (Auth::attempt($credentials)) {
            $funcionario = Auth::user();
            $cargo = strtolower(optional($funcionario->cargo)->nome);

            // Regenera a sessão para segurança
            $request->session()->regenerate();

            if ($cargo === 'adm') {
                session(['admin_logged_in' => true]);
                return redirect()->route('dashboard.admin');
            }

            if ($cargo === 'cozinheiro') {
                session(['cozinheiro_logged_in' => true]);
                return redirect()->route('dashboard.cozinheiro');
            }
            if ($cargo === 'editor') {
                session(['editor_logged_in' => true]);
                return redirect()->route('dashboard.editor');
            }
            if ($cargo === 'degustador') {
                session(['degustador_logged_in' => true]);
                return redirect()->route('dashboard.degustador');
            }

            return redirect()->route('dashboard.funcionario');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.'])->withInput();
    }


    // Mostra o formulário de cadastro
    public function showCadastroForm()
    {
        $cargos = Cargo::where('ativo', true)->get();
        return view('auth.cadastro', compact('cargos'));
    }

    // Processa o cadastro de um novo funcionário
    public function cadastrarFuncionario(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|unique:funcionarios,email',
            'password' => 'required|string|min:6|confirmed',
            'cargo_id' => 'required|exists:gmg_cargo,id', // Ajuste para tabela correta
            'rg' => 'nullable|string|max:30',
            'salario' => 'nullable|numeric',
            'data_inicio' => 'nullable|date',
            'data_finalizacao' => 'nullable|date',
            'nome_fantasia' => 'nullable|string|max:100',
        ]);

        Funcionario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password), // criptografa explicitamente
            'cargo_id' => $request->cargo_id,
            'rg' => $request->rg,
            'salario' => $request->salario,
            'data_inicio' => $request->data_inicio ?? now()->toDateString(),
            'data_finalizacao' => $request->data_finalizacao,
            'nome_fantasia' => $request->nome_fantasia,
        ]);

        return redirect()->route('login')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
