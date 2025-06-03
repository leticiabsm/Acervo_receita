<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Para as FKs

class Receita extends Model
{
    use HasFactory;

    protected $table = 'gmg_receitas';
    protected $primaryKey = 'idReceitas'; // A nova PK

    // Indica que a chave primária não é auto-incrementável (se for definida manualmente)
    // Se idReceitas for auto-incrementável no BD, remova esta linha:
    public $incrementing = true; // Se você gerencia idReceitas manualmente no seu DDL, mantenha. Se for AUTO_INCREMENT, remova.

    // Se a PK é auto-incrementável e do tipo INT, o Laravel infere.
    // Se não for INT (ex: UUID), ou se você está usando um nome diferente de 'id', ou se incrementing=false:
    // protected $keyType = 'string'; // Exemplo para UUIDs, se não for int

    // Se você usa 'dt_criacao' no lugar de 'created_at' do Laravel
    // public $timestamps = false; // Desativa os timestamps automáticos do Laravel se não for usá-los

    protected $fillable = [
        'idReceitas', // Inclua se você estiver definindo o ID manualmente ou for um campo que pode ser preenchido
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

    // Se você tem colunas de data/hora que não são created_at/updated_at,
    // e quer que o Laravel as trate como Carbon instances:
    protected $casts = [
        'dt_criacao' => 'date',
        'tempo_de_preparo' => 'datetime', // Laravel pode ter dificuldade com TIME apenas, datetime é mais flexível
        'quat_porcao' => 'decimal:1', // Para garantir que o decimal seja tratado corretamente
    ];


    /**
     * Uma receita pertence a um cozinheiro (funcionario).
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cozinheiro(): BelongsTo
    {
        // Ajuste 'App\Models\Funcionario' para o nome correto do seu modelo de funcionário/cozinheiro
        // e 'FK_idFuncionario' se a PK da tabela de funcionários for diferente
        return $this->belongsTo(Funcionario::class, 'FKcozinheiro', 'FK_idFuncionario');
    }

    /**
     * Uma receita pertence a uma categoria.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria(): BelongsTo
    {
        // Ajuste 'App\Models\Categoria' para o nome correto do seu modelo de categoria
        return $this->belongsTo(Categoria::class, 'FKCategoria', 'idCategoria');
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
                    ->withPivot('idMedida', 'quantidade', 'observacao')
                    ->withTimestamps(); // Se a tabela pivô tiver created_at/updated_at
    }
}