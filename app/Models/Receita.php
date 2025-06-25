<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Para as FKs

class Receita extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'gmg_receitas';
    protected $primaryKey = 'idReceitas'; // A nova PK


    public $incrementing = true;
    protected $fillable = [
        'idReceitas',
        'status',
        'nome_rec',
        'FKcozinheiro',
        'FKCategoria',
        'dt_criacao',
        'preparo',
        'quat_porcao',
        'ind_rec_inedita',
        'dificudade_receitas',
        'tempo_de_preparo',
        // 'created_at', 'updated_at' (se public $timestamps = true; )
    ];


    protected $casts = [
        'dt_criacao' => 'date',
        'tempo_de_preparo' => 'datetime',
        'quat_porcao' => 'decimal:1',
    ];


    /**
     * Uma receita pertence a um cozinheiro (funcionario).
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cozinheiro(): BelongsTo
    {

        return $this->belongsTo(Funcionario::class, 'FKcozinheiro', 'id');
    }

    /**
     * Uma receita pertence a uma categoria.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'FKCategoria', 'id_cat');
    }


    /**
     * Uma receita tem muitos ingredientes (com suas medidas e quantidades).
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredientes(): BelongsToMany
    {
        // O segundo argumento é o nome da tabela pivô: 'gmg_receita_ingrediente'
        // O terceiro é a chave estrangeira do modelo atual (Receita): 'idReceitas'
        // O quarto é a chave estrangeira do modelo relacionado (Ingrediente): 'idIngrediente'
        return $this->belongsToMany(Ingrediente::class, 'gmg_receita_ingrediente', 'idReceitas', 'idIngrediente')
            ->withPivot('idMedida', 'quantidade', 'observacao');
            
    }
}
