<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmgMedida extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     * Corresponde a `GMG_Medida` no seu SQL.
     *
     * @var string
     */
    protected $table = 'GMG_Medida';

    /**
     * A chave primária da tabela.
     * Corresponde a `idMedida` no seu SQL.
     *
     * @var string
     */
    protected $primaryKey = 'idMedida';

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
        'decricao', // Mantido como 'decricao' conforme seu SQL original.
    ];

    // Se você precisar de casts para tipos de dados, adicione-os aqui.
    // Exemplo: protected $casts = ['idMedida' => 'integer'];
}