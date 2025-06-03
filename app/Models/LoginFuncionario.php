<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; // Para o relacionamento com Funcionario

class LoginFuncionario extends Model
{
    use HasFactory;

    protected $table = 'login_funcionario'; // Define o nome da tabela no banco de dados
    protected $primaryKey = 'FkEmail'; // Define a chave primária personalizada

    // A chave primária não é auto-incrementável
    public $incrementing = false;

    // A chave primária é do tipo string
    protected $keyType = 'string';

    // Desativa os timestamps automáticos do Eloquent, pois a tabela não tem created_at/updated_at
    public $timestamps = false;

    protected $fillable = [
        'FkEmail', // Inclua a PK se ela for preenchida manualmente (como um e-mail)
        'senha',
    ];

    // Se você precisar de casts específicos para a senha (ex: para criptografia/descriptografia automática)
    // protected $casts = [
    //     'senha' => 'string', // Garante que seja tratada como string
    // ];

    /**
     * Um registro de login pode pertencer a um funcionário.
     * (Assumindo que FKEmail_Funcionarios em GMG_Cadastro_de_Funcionario referencia FkEmail aqui)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function funcionario(): HasOne
    {
        // 'Funcionario::class' é o modelo de funcionário
        // 'FKEmail_Funcionarios' é a chave estrangeira na tabela 'gmg_cadastro_de_funcionario'
        // 'FkEmail' é a chave primária desta tabela 'login_funcionario'
        return $this->hasOne(Funcionario::class, 'FKEmail_Funcionarios', 'FkEmail');
    }
}
