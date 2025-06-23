<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroPublicado extends Model
{
    protected $table = 'livros_publicados'; // ou o nome da tabela real
    
    protected $fillable = ['livro_id', 'funcionario_id', 'nota_id', 'isbn', 'editor', 'titulo'];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function degustacao()
    {
        return $this->belongsTo(Degustacao::class);
    }
}
