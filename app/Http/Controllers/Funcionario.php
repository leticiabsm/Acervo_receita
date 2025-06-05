<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'gmg_cadastro_de_funcionario'; // Define o nome da tabela no banco de dados
    protected $primaryKey = 'FK_idFuncionario'; // Define a chave primária personalizada

    // A chave primária é auto-incrementável por padrão, mas se você a definiu como `increments()` na migration,
    // o Laravel já infere isso. Se for um ID manual, defina `public $incrementing = false;`.

    // Se você não usa os timestamps created_at e updated_at nesta tabela, desative:
    // public $timestamps = false;

    protected $fillable = [
        'rg',
        'nome',
        'dt_adm',
        'salario',
        'FKCargo',
        'foto_perfil',
        'FKEmail_Funcionarios',
        'nome_fantasia',
        'data_fim_funcionario',
        'ind_funcionario',
    ];

    // Para que o Laravel trate colunas de data/hora/decimal/booleano como objetos Carbon ou tipos específicos
    protected $casts = [
        'dt_adm' => 'date',
        'salario' => 'decimal:2',
        'data_fim_funcionario' => 'date',
        'ind_funcionario' => 'boolean', // Converte 0/1 para false/true
    ];

    /**
     * Um funcionário pertence a um cargo.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cargo(): BelongsTo
    {
        // Ajuste 'App\Models\Cargo' para o nome correto do seu modelo de cargo
        // e 'idCargo' se a PK da tabela de cargos for diferente
        return $this->belongsTo(Cargo::class, 'FKCargo', 'idCargo');
    }

    /**
     * Um funcionário tem um login (relacionamento com a tabela Login_Funcionario).
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function login(): BelongsTo
    {
        // Ajuste 'App\Models\LoginFuncionario' para o nome correto do seu modelo de login
        // e 'FkEmail' se a PK da tabela de login for diferente
        return $this->belongsTo(LoginFuncionario::class, 'FKEmail_Funcionarios', 'FkEmail');
    }

    /**
     * Um funcionário (cozinheiro) pode ter muitas receitas.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receitas(): HasMany
    {
        // 'Receita::class' é o modelo de receita
        // 'FKcozinheiro' é a chave estrangeira na tabela 'gmg_receitas' que aponta para este funcionário
        // 'FK_idFuncionario' é a chave primária desta tabela 'gmg_cadastro_de_funcionario'
        return $this->hasMany(Receita::class, 'FKcozinheiro', 'FK_idFuncionario');
    }
}