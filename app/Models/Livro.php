<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Livro extends Model
{
    use HasFactory;

    protected $table = 'gmg_livro'; // Define o nome da tabela associada ao modelo

    protected $fillable = ['idlivro', 'titulo', 'isbn']; // Permite atribuição em massa

    public $timestamps = true; // Desativa os timestamps, se não forem utilizados

    protected $primaryKey = 'idlivro';



    public function receitas()
    {
        return $this->hasMany(Receita::class, 'FKLivro', 'idlivro');
    }
    public function editor()
    {
        return $this->belongsTo(Editor::class, 'editor_id', 'id');
    }
}
