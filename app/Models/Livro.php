<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'gmg_livro';
    protected $primaryKey = 'idlivro';
    public $timestamps = true;

    protected $fillable = [
        'idlivro',
        'titulo',
        'isbn',
        'editor',
        'cozinheiro',
        'nome_fantasia',
    ];

    public function receitas()
    {
        return $this->hasMany(Receita::class, 'FKLivro', 'idlivro');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'FKLivro', 'idlivro');
    }
}