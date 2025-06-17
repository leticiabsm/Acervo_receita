<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'gmg_categoria';
    public $timestamps = false;
    protected $primaryKey = 'idCategoria';
    protected $fillable = ['nome_categoria', 'descricao', 'data_inicio_categoria', 'data_fim_categoria', 'ind_ativo'];

}
