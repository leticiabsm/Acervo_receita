<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmgIngrediente extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     * Corresponde a `GMG_Ingrediente` no seu SQL.
     *
     * @var string
     */
    protected $table = 'GMG_Ingrediente';

    /**
     * A chave primária da tabela.
     * Corresponde a `idIngrediente` no seu SQL.
     *
     * @var string
     */
    protected $primaryKey = 'idIngrediente';

    /**
     * Indica se o modelo deve ser timestamped.
     * Definido como `false` porque suas tabelas não têm `created_at` e `updated_at`.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Os atributos que são preenchíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
    ];

    // Se você precisar de casts para tipos de dados, adicione-os aqui.
    // Exemplo: protected $casts = ['idIngrediente' => 'integer'];
}