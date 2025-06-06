<?php
// app/Models/Medida.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Importe este

class Medida extends Model
{
    use HasFactory;

    protected $table = 'gmg_medidas';
    protected $primaryKey = 'idMedida';

    protected $fillable = [
        'tipo',
        'item',
        'descricao', // Agora, 'descricao' é a quantidade
    ];

    // Se a tabela não usar created_at e updated_at
    // public $timestamps = false;

    /**
     * Uma medida pode estar associada a muitos ingredientes.
     */
    public function ingredientes(): BelongsToMany
    {
        // Os argumentos são os mesmos, mas as chaves estrangeiras são invertidas
        return $this->belongsToMany(Ingrediente::class, 'gmg_ingrediente_medida', 'idMedida', 'idIngrediente')
                    ->withPivot('quantidade', 'observacao') // Inclui as colunas extras da tabela pivô
                    ->withTimestamps(); // Se a tabela pivô tiver created_at/updated_at
    }
}
