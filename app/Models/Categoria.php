<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'gmg_categoria';
    public $timestamps = false;
    protected $primaryKey = 'id_cat';

    protected $fillable = [
        'nome_cat',
        'desc',
        'dt_ini_cat',
        'dt_fim_cat',
        'ativo',
    ];
}
