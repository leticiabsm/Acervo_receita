<?php

// app/Models/Ingrediente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Importe este

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'gmg_Ingredientes';
    protected $primaryKey = 'idIngrediente';

    public $timestamps = false;

    protected $fillable = ['nome', 'descricao', 'ind_ativo'];

    public function medidas(): BelongsToMany
    {
        return $this->belongsToMany(
            Medida::class,
            'gmg_ingrediente_medida',   // <- tabela intermediária correta
            'idIngrediente',
            'idMedida'
        )
            ->withPivot('quantidade', 'observacao');
    }
}
