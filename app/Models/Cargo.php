<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Para o relacionamento com Funcionario

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'gmg_cargo'; // Define o nome da tabela no banco de dados
    protected $primaryKey = 'idCargo'; // Define a chave primária personalizada

    // Desativa os timestamps automáticos do Eloquent, pois a tabela não tem created_at/updated_at
    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'data_inicio',
        'data_fim',
        'ind_ativo',
        'nome',
    ];

    // Para que o Laravel trate colunas de data/booleano como objetos Carbon ou tipos específicos
    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'ind_ativo' => 'boolean', // Converte 0/1 para false/true
    ];

    /**
     * Um cargo pode ter muitos funcionários.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function funcionarios(): HasMany
    {
        // 'Funcionario::class' é o modelo de funcionário
        // 'FKCargo' é a chave estrangeira na tabela 'gmg_cadastro_de_funcionario' que aponta para este cargo
        // 'idCargo' é a chave primária desta tabela 'gmg_cargo'
        return $this->hasMany(Funcionario::class, 'FKCargo', 'idCargo');
    }
}