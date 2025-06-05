<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Para o relacionamento com Receita

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'gmg_categoria'; // Define o nome da tabela no banco de dados
    protected $primaryKey = 'idCategoria'; // Define a chave primária personalizada

    // Se você não usa os timestamps created_at e updated_at nesta tabela
    public $timestamps = false; // DESATIVE se a tabela não tiver created_at/updated_at

    protected $fillable = [
        'descricao',
        'ind_ativo',
        'data_fim_categoria',
        'nome_categoria',
    ];

    // Se você quer que o Laravel trate `data_fim_categoria` como um objeto Carbon (data)
    protected $casts = [
        'data_fim_categoria' => 'date',
        'ind_ativo' => 'boolean', // Trata 0/1 como booleano true/false
    ];

    /**
     * Uma categoria pode ter muitas receitas.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receitas(): HasMany
    {
        // 'Receita::class' é o modelo de receita
        // 'FKCategoria' é a chave estrangeira na tabela 'gmg_receitas' que aponta para esta categoria
        // 'idCategoria' é a chave primária desta tabela 'gmg_categoria'
        return $this->hasMany(Receita::class, 'FKCategoria', 'idCategoria');
    }
}