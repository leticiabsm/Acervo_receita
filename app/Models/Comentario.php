<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function livro()
    {
        return $this->belongsTo(Livro::class, 'FKLivro', 'idlivro');
    }
}