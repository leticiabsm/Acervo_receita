<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cozinheiro extends Model
{
    protected $table = 'cozinheiros'; // ajuste se o nome da tabela for diferente

    public function receitas()
    {
        return $this->hasMany(Receita::class, 'cozinheiro_id', 'id');
    }
}