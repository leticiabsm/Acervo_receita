<?php

// app/Models/Ingrediente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Importe este

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'GMG_Ingredientes';
    protected $primaryKey = 'idIngrediente';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    // Se a tabela não usar created_at e updated_at
    // public $timestamps = false;

    /**
     * Um ingrediente pode ter muitas medidas.
     */
    public function medidas(): BelongsToMany
    {
        // O primeiro argumento é o nome do Model relacionado.
        // O segundo argumento é o nome da tabela pivô.
        // O terceiro argumento é o nome da chave estrangeira do Model que você está definindo (Ingrediente).
        // O quarto argumento é o nome da chave estrangeira do Model que está sendo relacionado (Medida).
        return $this->belongsToMany(Medida::class, 'GMG_Receitas_Ingrediente', 'idIngrediente', 'idMedida')
                    ->withPivot('quantidade', 'observacao') // Inclui as colunas extras da tabela pivô
                    ->withTimestamps(); // Se a tabela pivô tiver created_at/updated_at
    }
}