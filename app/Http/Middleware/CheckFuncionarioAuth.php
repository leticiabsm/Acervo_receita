<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckFuncionarioAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_logged_in') || !session('funcionario_id')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}