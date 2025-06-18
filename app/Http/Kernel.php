<?php


namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    protected $routeMiddleware = [
        
        // ...outros middlewares...
        'admin.auth' => \App\Http\Middleware\AdminAuth::class,
        'funcionarioauth' => \App\Http\Middleware\CheckFuncionarioAuth::class
    ];
}
