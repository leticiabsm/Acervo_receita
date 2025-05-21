<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['nome', 'descricao', 'data_inicio', 'data_fim', 'ind_ativo'];

}
