<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroPublicado extends Model
{
    protected $table = 'livros_publicados';

    protected $fillable = ['livro_id', 'funcionario_id', 'nota_id', 'isbn', 'editor', 'titulo'];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_id', 'idlivro');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id', 'id');
    }

    public function degustacao()
    {
        return $this->belongsTo(Degustacao::class, 'nota_id', 'id');
    }
}
