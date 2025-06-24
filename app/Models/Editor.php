<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    use HasFactory;

    // Se a tabela no banco se chama 'editors', não precisa definir.
    // Se for diferente, defina:
    // protected $table = 'nome_da_tabela';

    // Se a chave primária não for 'id', defina:
    // protected $primaryKey = 'id_editor';

    // Se não quiser timestamps automáticos:
    // public $timestamps = false;

    // Defina os campos que podem ser preenchidos em massa:
    // protected $fillable = ['nome', 'email', ...];
}